FROM php:8.2-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    libpq-dev

# Instalar extensiones PHP para PostgreSQL
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar directorio de trabajo
WORKDIR /var/www

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Instalar y compilar frontend
WORKDIR /var/www/public/chatbot
RUN npm install && npm run build && cp -r dist/* .

# Volver al directorio principal
WORKDIR /var/www

# Exponer puerto
EXPOSE 8080

# Comando de inicio
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080