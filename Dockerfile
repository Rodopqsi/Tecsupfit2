FROM php:8.2-cli

# 1. Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    gnupg \
    ca-certificates

# 2. Instalar Node.js (requisito para Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# 3. Instalar extensiones PHP para PostgreSQL
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# 4. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Configurar directorio de trabajo
WORKDIR /var/www

# 6. Copiar archivos del proyecto
COPY . .

# 7. Instalar dependencias de PHP y Node.js
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# 8. Exponer puerto
EXPOSE 8080

# 9. Comando de inicio
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080
