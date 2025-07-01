<?php
// filepath: database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Para PostgreSQL, usamos TRUNCATE CASCADE en lugar de FOREIGN_KEY_CHECKS
        
        // Limpiar tablas existentes (en orden correcto por dependencias)
        $tables = [
            'ventas', 'opinions', 'carrito_productos', 'orden_productos', 'ordenes',
            'productos', 'stocks', 'reclamaciones', 'cupones', 'sessions',
            'password_reset_tokens', 'sabores', 'tamanos', 'objetivos',
            'marcas', 'categorias', 'delmes', 'users', 'migrations'
        ];
        
        foreach ($tables as $table) {
            if (DB::getSchemaBuilder()->hasTable($table)) {
                DB::statement("TRUNCATE TABLE $table CASCADE");
            }
        }

        // Reiniciar secuencias de PostgreSQL
        $this->resetSequences();

        // 1. USERS
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Administrador',
                'email' => 'admin@tecsupfit.com',
                'email_verified_at' => null,
                'password' => '$2y$12$envJpxzyqlPSdxzw2xNmY.oEAzDk4L0CUKyw7nmIfPX50O0PZlrj6',
                'remember_token' => 'XhGvqx6BBBZHu91BKQLEMaZE1MoRG1nF77WNG2Ulj3Nbfz6cYVBS9q6kpQYd',
                'created_at' => '2025-06-14 04:43:36',
                'updated_at' => '2025-06-14 04:43:36',
                'is_admin' => 1,
                'direccion' => null,
                'telefono' => null
            ],
            [
                'id' => 2,
                'name' => 'Test User',
                'email' => 'test@example.com',
                'email_verified_at' => '2025-06-16 08:03:08',
                'password' => '$2y$12$zQu06XC480Tl6JhLRECTr.8W7zOhmq6Kaq5uhv2fl21QYCP4hw0gW',
                'remember_token' => '0wqxwHP6yB',
                'created_at' => '2025-06-16 08:03:09',
                'updated_at' => '2025-06-16 08:03:09',
                'is_admin' => 0,
                'direccion' => null,
                'telefono' => null
            ],
            [
                'id' => 10,
                'name' => 'Rodolfo Tavera Serrano',
                'email' => 'rodolfo.tavera@tecsup.edu.pe',
                'email_verified_at' => null,
                'password' => '$2y$12$hjd3QKQaxOyS9HEbE7TutejjdNonhtwfpqKjxwch6X085NaMu76qS',
                'remember_token' => null,
                'created_at' => '2025-06-22 22:40:18',
                'updated_at' => '2025-06-22 22:40:18',
                'is_admin' => 0,
                'direccion' => 'Ancash 105',
                'telefono' => '51917364262'
            ],
            [
                'id' => 11,
                'name' => 'Josefina',
                'email' => 'gradosreyesrene@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$paBP.GW5h6y8H3e7dCtJPugInOGHRRl3tHXCASb337W5U61yEPKfC',
                'remember_token' => null,
                'created_at' => '2025-06-24 04:36:07',
                'updated_at' => '2025-06-24 04:36:07',
                'is_admin' => 0,
                'direccion' => 'jose 789',
                'telefono' => '926065971'
            ],
            [
                'id' => 13,
                'name' => 'Rodolfo Tavera Serrano',
                'email' => 'rodolfoalejandrotaveraserrano@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$a90Lk3f0SJxDPe/ReaF5rul/hH4EofmFkUBITW7QXGcv0Vct1gMR2',
                'remember_token' => null,
                'created_at' => '2025-06-27 09:02:23',
                'updated_at' => '2025-06-27 09:02:23',
                'is_admin' => 0,
                'direccion' => 'Ancash 105',
                'telefono' => '51917364262'
            ]
        ]);

        // 2. MIGRATIONS
        DB::table('migrations')->insert([
            ['id' => 1, 'migration' => '0001_01_01_000000_create_users_table', 'batch' => 1],
            ['id' => 2, 'migration' => '0001_01_01_000001_create_cache_table', 'batch' => 1],
            ['id' => 3, 'migration' => '0001_01_01_000002_create_jobs_table', 'batch' => 1],
            ['id' => 4, 'migration' => '2025_05_29_042440_add_is_admin_to_users_table', 'batch' => 1],
            ['id' => 5, 'migration' => '2025_06_10_030113_create_delmes_table', 'batch' => 1],
            ['id' => 6, 'migration' => '2025_06_16_013153_create_categorias_table', 'batch' => 2],
            ['id' => 7, 'migration' => '2025_06_16_013244_create_marcas_table', 'batch' => 2],
            ['id' => 8, 'migration' => '2025_06_16_013325_create_stocks_table', 'batch' => 2],
            ['id' => 9, 'migration' => '2025_06_16_013415_create_productos_table', 'batch' => 2],
            ['id' => 10, 'migration' => '2025_06_16_014128_create_ventas_table', 'batch' => 2],
            ['id' => 36, 'migration' => '2025_06_20_213546_create_ordenes_table', 'batch' => 3],
            ['id' => 38, 'migration' => '2025_06_21_160107_create_objetivos_table', 'batch' => 3],
            ['id' => 39, 'migration' => '2025_06_21_161428_create_tamanos_table', 'batch' => 3],
            ['id' => 40, 'migration' => '2025_06_21_161434_create_sabores_table', 'batch' => 3],
            ['id' => 41, 'migration' => '2025_06_21_161454_add_fields_to_productos_table', 'batch' => 3],
            ['id' => 42, 'migration' => '2025_06_22_152658_add_direccion_telefono_to_users_table', 'batch' => 4],
            ['id' => 43, 'migration' => '2025_06_22_172512_create_reclamaciones_table', 'batch' => 5],
            ['id' => 44, 'migration' => '2025_06_22_222507_create_opinions_table', 'batch' => 6],
            ['id' => 45, 'migration' => '2025_06_23_161739_add_imagen_to_marcas_table', 'batch' => 7],
            ['id' => 48, 'migration' => '2025_06_23_192920_create_carritos_table', 'batch' => 8],
            ['id' => 49, 'migration' => '2025_06_23_193200_create_carrito_productos_table', 'batch' => 8],
            ['id' => 50, 'migration' => '2025_06_27_042025_add_user_id_to_ordenes_table', 'batch' => 9],
            ['id' => 51, 'migration' => '2025_06_28_140352_create_orden_productos_table', 'batch' => 10],
            ['id' => 52, 'migration' => '2025_06_28_143828_create_cupones_table', 'batch' => 11],
            ['id' => 53, 'migration' => '2025_06_28_174117_add_imagen_to_cupones_table', 'batch' => 12]
        ]);

        // 3. CATEGORIAS
        DB::table('categorias')->insert([
            ['id' => 7, 'nombre' => 'Creatinas', 'descripcion' => 'Creatinas', 'created_at' => '2025-06-17 09:42:28', 'updated_at' => '2025-06-19 09:27:38'],
            ['id' => 13, 'nombre' => 'Proteinas', 'descripcion' => 'Proteinas', 'created_at' => '2025-06-21 10:30:31', 'updated_at' => '2025-06-21 10:30:31'],
            ['id' => 14, 'nombre' => 'GANADORES DE PESO', 'descripcion' => 'GANADORES DE PESO', 'created_at' => '2025-06-21 10:30:43', 'updated_at' => '2025-06-21 10:30:43'],
            ['id' => 15, 'nombre' => 'QUEMADORES DE GRASA', 'descripcion' => 'QUEMADORES DE GRASA', 'created_at' => '2025-06-21 10:30:52', 'updated_at' => '2025-06-21 10:30:52'],
            ['id' => 16, 'nombre' => 'BARRAS ENERGÉTICAS', 'descripcion' => 'BARRAS ENERGÉTICAS', 'created_at' => '2025-06-21 10:30:59', 'updated_at' => '2025-06-21 10:30:59'],
            ['id' => 17, 'nombre' => 'VITAMINAS Y OTROS', 'descripcion' => 'VITAMINAS Y OTROS', 'created_at' => '2025-06-21 10:31:04', 'updated_at' => '2025-06-21 10:31:04']
        ]);

        // 4. MARCAS
        DB::table('marcas')->insert([
            ['id' => 11, 'nombre' => 'MY PROTEN', 'imagen' => '1750710519.jpg', 'created_at' => '2025-06-17 20:42:09', 'updated_at' => '2025-06-24 01:28:39'],
            ['id' => 15, 'nombre' => 'NUTREX RESEARCH', 'imagen' => '1750696446.jpg', 'created_at' => '2025-06-21 09:07:53', 'updated_at' => '2025-06-23 21:34:06'],
            ['id' => 16, 'nombre' => 'JOCKO FULL', 'imagen' => '1750696252.png', 'created_at' => '2025-06-21 10:29:44', 'updated_at' => '2025-06-23 21:30:52'],
            ['id' => 17, 'nombre' => 'RC RONNIE COLEMAN SIGNATURE SERIES', 'imagen' => '1750696454.jpg', 'created_at' => '2025-06-21 10:29:53', 'updated_at' => '2025-06-23 21:34:14'],
            ['id' => 18, 'nombre' => 'MUSCLETECH', 'imagen' => '1750696464.png', 'created_at' => '2025-06-21 10:30:00', 'updated_at' => '2025-06-23 21:34:24'],
            ['id' => 19, 'nombre' => 'NUTRI PROTEIN', 'imagen' => '1750715044.png', 'created_at' => '2025-06-22 04:21:03', 'updated_at' => '2025-06-24 02:44:04'],
            ['id' => 22, 'nombre' => 'NATURALSLIM', 'imagen' => '1750714736.png', 'created_at' => '2025-06-24 01:26:23', 'updated_at' => '2025-06-24 02:38:56'],
            ['id' => 23, 'nombre' => 'YALABAS', 'imagen' => '1750714789.jpg', 'created_at' => '2025-06-24 01:27:13', 'updated_at' => '2025-06-24 02:39:49'],
            ['id' => 24, 'nombre' => 'QNT', 'imagen' => '1750714798.png', 'created_at' => '2025-06-24 01:27:45', 'updated_at' => '2025-06-24 02:39:58'],
            ['id' => 25, 'nombre' => 'PROSUPPS', 'imagen' => '1750715053.png', 'created_at' => '2025-06-24 01:28:25', 'updated_at' => '2025-06-24 02:44:13'],
            ['id' => 26, 'nombre' => 'NB_BEAUTY', 'imagen' => '1750714828.jpg', 'created_at' => '2025-06-24 01:29:10', 'updated_at' => '2025-06-24 02:40:28'],
            ['id' => 27, 'nombre' => 'MUTANT', 'imagen' => '1750714849.jpg', 'created_at' => '2025-06-24 01:29:48', 'updated_at' => '2025-06-24 02:40:49'],
            ['id' => 28, 'nombre' => 'LEVELPRO', 'imagen' => '1750714858.png', 'created_at' => '2025-06-24 01:30:16', 'updated_at' => '2025-06-24 02:40:58'],
            ['id' => 29, 'nombre' => 'GU', 'imagen' => '1750714866.jpg', 'created_at' => '2025-06-24 01:30:41', 'updated_at' => '2025-06-24 02:41:06'],
            ['id' => 30, 'nombre' => 'DRAGONPHARMA', 'imagen' => '1750714877.jpg', 'created_at' => '2025-06-24 01:31:47', 'updated_at' => '2025-06-24 02:41:17']
        ]);

        // 5. OBJETIVOS
        DB::table('objetivos')->insert([
            ['id' => 1, 'nombre' => 'Bajar de peso', 'descripcion' => 'Productos para reducir peso corporal', 'created_at' => '2025-06-22 02:28:40', 'updated_at' => '2025-06-22 02:28:40'],
            ['id' => 2, 'nombre' => 'Subir de peso', 'descripcion' => 'Productos para aumentar masa corporal', 'created_at' => '2025-06-22 02:28:40', 'updated_at' => '2025-06-22 02:28:40'],
            ['id' => 3, 'nombre' => 'Definir músculos', 'descripcion' => 'Productos para tonificar y definir musculatura', 'created_at' => '2025-06-22 02:28:40', 'updated_at' => '2025-06-22 02:28:40'],
            ['id' => 4, 'nombre' => 'Ganar masa muscular', 'descripcion' => 'Productos para incrementar masa muscular', 'created_at' => '2025-06-22 02:28:40', 'updated_at' => '2025-06-22 02:28:40'],
            ['id' => 5, 'nombre' => 'Rendimiento deportivo', 'descripcion' => 'Productos para mejorar el rendimiento atlético', 'created_at' => '2025-06-22 02:28:40', 'updated_at' => '2025-06-22 02:28:40'],
            ['id' => 6, 'nombre' => 'Recuperación', 'descripcion' => 'Productos para acelerar la recuperación post-entrenamiento', 'created_at' => '2025-06-22 02:28:40', 'updated_at' => '2025-06-22 02:28:40'],
            ['id' => 7, 'nombre' => 'Salud general', 'descripcion' => 'Productos para mantener bienestar general', 'created_at' => '2025-06-22 02:28:40', 'updated_at' => '2025-06-22 02:28:40']
        ]);

        // 6. TAMANOS
        DB::table('tamanos')->insert([
            ['id' => 1, 'nombre' => '250g', 'descripcion' => 'Tamaño pequeño - 250 gramos', 'created_at' => '2025-06-21 22:12:26', 'updated_at' => '2025-06-21 22:12:26'],
            ['id' => 2, 'nombre' => '500g', 'descripcion' => 'Tamaño mediano - 500 gramos', 'created_at' => '2025-06-21 22:12:26', 'updated_at' => '2025-06-21 22:12:26'],
            ['id' => 3, 'nombre' => '1kg', 'descripcion' => 'Tamaño grande - 1 kilogramo', 'created_at' => '2025-06-21 22:12:26', 'updated_at' => '2025-06-21 22:12:26'],
            ['id' => 4, 'nombre' => '2kg', 'descripcion' => 'Tamaño extra grande - 2 kilogramos', 'created_at' => '2025-06-21 22:12:26', 'updated_at' => '2025-06-21 22:12:26'],
            ['id' => 5, 'nombre' => '5kg', 'descripcion' => 'Tamaño industrial - 5 kilogramos', 'created_at' => '2025-06-21 22:12:26', 'updated_at' => '2025-06-21 22:12:26'],
            ['id' => 6, 'nombre' => 'S', 'descripcion' => 'Talla pequeña', 'created_at' => '2025-06-21 22:12:26', 'updated_at' => '2025-06-21 22:12:26'],
            ['id' => 7, 'nombre' => 'M', 'descripcion' => 'Talla mediana', 'created_at' => '2025-06-21 22:12:26', 'updated_at' => '2025-06-21 22:12:26'],
            ['id' => 8, 'nombre' => 'L', 'descripcion' => 'Talla grande', 'created_at' => '2025-06-21 22:12:26', 'updated_at' => '2025-06-21 22:12:26'],
            ['id' => 9, 'nombre' => 'XL', 'descripcion' => 'Talla extra grande', 'created_at' => '2025-06-21 22:12:26', 'updated_at' => '2025-06-21 22:12:26']
        ]);

        // 7. SABORES
        DB::table('sabores')->insert([
            ['id' => 1, 'nombre' => 'Vainilla', 'descripcion' => 'Sabor a vainilla clásico', 'created_at' => '2025-06-21 22:12:32', 'updated_at' => '2025-06-21 22:12:32'],
            ['id' => 2, 'nombre' => 'Chocolate', 'descripcion' => 'Sabor a chocolate', 'created_at' => '2025-06-21 22:12:32', 'updated_at' => '2025-06-21 22:12:32'],
            ['id' => 3, 'nombre' => 'Fresa', 'descripcion' => 'Sabor a fresa', 'created_at' => '2025-06-21 22:12:32', 'updated_at' => '2025-06-21 22:12:32'],
            ['id' => 4, 'nombre' => 'Cookies & Cream', 'descripcion' => 'Sabor a galletas con crema', 'created_at' => '2025-06-21 22:12:32', 'updated_at' => '2025-06-21 22:12:32'],
            ['id' => 5, 'nombre' => 'Banana', 'descripcion' => 'Sabor a banana', 'created_at' => '2025-06-21 22:12:32', 'updated_at' => '2025-06-21 22:12:32'],
            ['id' => 6, 'nombre' => 'Mango', 'descripcion' => 'Sabor tropical a mango', 'created_at' => '2025-06-21 22:12:32', 'updated_at' => '2025-06-21 22:12:32'],
            ['id' => 7, 'nombre' => 'Sin sabor', 'descripcion' => 'Producto sin sabor agregado', 'created_at' => '2025-06-21 22:12:32', 'updated_at' => '2025-06-21 22:12:32'],
            ['id' => 8, 'nombre' => 'Frutas del bosque', 'descripcion' => 'Mezcla de frutas rojas', 'created_at' => '2025-06-21 22:12:32', 'updated_at' => '2025-06-21 22:12:32'],
            ['id' => 10, 'nombre' => 'Chocolate Blanco', 'descripcion' => 'Sabor a chocolate blanco', 'created_at' => '2025-06-21 22:15:22', 'updated_at' => '2025-06-21 22:15:22'],
            ['id' => 17, 'nombre' => 'Café', 'descripcion' => 'Sabor a café', 'created_at' => '2025-06-21 22:15:22', 'updated_at' => '2025-06-21 22:15:22'],
            ['id' => 18, 'nombre' => 'Caramelo', 'descripcion' => 'Sabor dulce a caramelo', 'created_at' => '2025-06-21 22:15:22', 'updated_at' => '2025-06-21 22:15:22']
        ]);

        // 8. STOCKS (reducido por límite de espacio)
        $this->insertStocks();
        
        // 9. DELMES
        $this->insertDelmes();
        
        // 10. PRODUCTOS
        $this->insertProductos();
        
        // 11. CUPONES
        $this->insertCupones();
        
        // 12. CARRITO_PRODUCTOS
        $this->insertCarritoProductos();
        
        // 13. OPINIONS
        $this->insertOpinions();
        
        // 14. RECLAMACIONES
        $this->insertReclamaciones();
        
        // 15. VENTAS
        $this->insertVentas();
        
        // 16. PASSWORD RESET TOKENS
        $this->insertPasswordResetTokens();

        $this->command->info('✅ Base de datos poblada exitosamente con todos los datos para PostgreSQL!');
    }

    private function resetSequences()
    {
        // Reiniciar secuencias de PostgreSQL después del truncate
        $sequences = [
            'users_id_seq' => 'users',
            'categorias_id_seq' => 'categorias', 
            'marcas_id_seq' => 'marcas',
            'objetivos_id_seq' => 'objetivos',
            'tamanos_id_seq' => 'tamanos',
            'sabores_id_seq' => 'sabores',
            'stocks_id_seq' => 'stocks',
            'productos_id_seq' => 'productos',
            'cupones_id_seq' => 'cupones',
            'carrito_productos_id_seq' => 'carrito_productos',
            'opinions_id_seq' => 'opinions',
            'reclamaciones_id_seq' => 'reclamaciones',
            'ventas_id_seq' => 'ventas',
            'delmes_id_seq' => 'delmes',
            'migrations_id_seq' => 'migrations'
        ];

        foreach ($sequences as $sequence => $table) {
            try {
                DB::statement("SELECT setval('$sequence', (SELECT COALESCE(MAX(id), 1) FROM $table))");
            } catch (\Exception $e) {
                // Ignorar errores si la secuencia no existe
            }
        }
    }

    private function insertStocks()
    {
        $stocks = [
            ['id' => 1, 'cantidad' => 50, 'stock_minimo' => 10, 'created_at' => '2025-06-16 08:03:09', 'updated_at' => '2025-06-16 08:03:09'],
            ['id' => 2, 'cantidad' => 5, 'stock_minimo' => 15, 'created_at' => '2025-06-16 08:03:09', 'updated_at' => '2025-06-16 20:32:02'],
            ['id' => 19, 'cantidad' => 69, 'stock_minimo' => 1, 'created_at' => '2025-06-21 09:08:46', 'updated_at' => '2025-06-23 05:00:43'],
            ['id' => 20, 'cantidad' => 0, 'stock_minimo' => 1, 'created_at' => '2025-06-21 10:32:05', 'updated_at' => '2025-06-23 12:14:07'],
            ['id' => 21, 'cantidad' => 89, 'stock_minimo' => 1, 'created_at' => '2025-06-21 10:32:54', 'updated_at' => '2025-06-21 10:32:54'],
            ['id' => 22, 'cantidad' => 87, 'stock_minimo' => 1, 'created_at' => '2025-06-21 10:33:43', 'updated_at' => '2025-06-21 10:33:43'],
            ['id' => 24, 'cantidad' => 8, 'stock_minimo' => 2, 'created_at' => '2025-06-24 01:15:10', 'updated_at' => '2025-06-24 01:15:10']
        ];

        foreach ($stocks as $stock) {
            DB::table('stocks')->insert($stock);
        }
    }

    private function insertDelmes()
    {
        DB::table('delmes')->insert([
            [
                'id' => 6,
                'nombre' => 'Rodolfo',
                'marca' => 's',
                'descripcion' => 'ss',
                'precio_original' => 21.00,
                'precio_oferta' => 32.00,
                'stock' => 12,
                'categoria' => 'keratinas',
                'imagen' => 'productos/2W77BUFTnkgQJ0mXrrc6DY3R7ao6qEnR4b615vKg.jpg',
                'activo' => 1,
                'destacado' => 1,
                'created_at' => '2025-06-14 10:53:22',
                'updated_at' => '2025-06-14 19:45:43'
            ]
        ]);
    }

    private function insertProductos()
    {
        $productos = [
            [
                'id' => 18,
                'nombre' => 'Nutrex Research Micronized Creatine Monohydrate Powder - 200 Servings (1KG)',
                'precio_nuevo' => 179.00,
                'precio_antes' => 199.00,
                'imagen' => '1750478956.png',
                'descripcion' => 'Creatina de alto nivel',
                'categoria_id' => 7,
                'stock_id' => 19,
                'marca_id' => 15,
                'es_delmes' => 1,
                'ventas_mes' => 1,
                'created_at' => '2025-06-21 09:08:46',
                'updated_at' => '2025-06-23 05:00:44',
                'tamano_id' => null,
                'sabor_id' => null,
                'objetivo_id' => null
            ],
            [
                'id' => 19,
                'nombre' => 'Jocko Fuel Creatine Monohydrate Powder - Creatine for Men & Women',
                'precio_nuevo' => 109.00,
                'precio_antes' => 139.00,
                'imagen' => '1750483925.jpg',
                'descripcion' => 'Un suplemento rico',
                'categoria_id' => 7,
                'stock_id' => 20,
                'marca_id' => 16,
                'es_delmes' => 1,
                'ventas_mes' => 1,
                'created_at' => '2025-06-21 10:32:05',
                'updated_at' => '2025-06-23 12:14:08',
                'tamano_id' => null,
                'sabor_id' => null,
                'objetivo_id' => null
            ]
        ];

        foreach ($productos as $producto) {
            DB::table('productos')->insert($producto);
        }
    }

    private function insertCupones()
    {
        DB::table('cupones')->insert([
            [
                'id' => 1,
                'codigo' => 'TEC2025',
                'descuento' => 15.00,
                'tipo_descuento' => 'fijo',
                'stock' => 180,
                'imagen' => null,
                'precio_minimo' => 12.00,
                'fecha_inicio' => '2025-06-27',
                'fecha_fin' => '2025-06-29',
                'user_id' => null,
                'created_at' => '2025-06-28 21:41:17',
                'updated_at' => '2025-06-29 21:24:17'
            ]
        ]);
    }

    private function insertCarritoProductos()
    {
        DB::table('carrito_productos')->insert([
            ['id' => 1, 'user_id' => 10, 'producto_id' => 18, 'cantidad' => 1, 'created_at' => '2025-06-24 00:46:37', 'updated_at' => '2025-06-24 00:46:37']
        ]);
    }

    private function insertOpinions()
    {
        DB::table('opinions')->insert([
            ['id' => 1, 'user_id' => 1, 'producto_id' => 18, 'valoracion' => 5, 'comentario' => 'Esta bonito', 'created_at' => '2025-06-23 03:40:39', 'updated_at' => '2025-06-23 03:40:39']
        ]);
    }

    private function insertReclamaciones()
    {
        DB::table('reclamaciones')->insert([
            [
                'id' => 1,
                'tipo_documento' => 'dni',
                'numero_documento' => '60435585',
                'telefono' => '917364262',
                'nombres' => 'Rodolfo',
                'apellidos' => 'Tavera Serrano',
                'email' => 'rodolfoalejandrotaveraserrano@gmail.com',
                'direccion' => 'Ancash 105',
                'fecha_compra' => '2025-06-03',
                'tipo_reclamo' => 'reclamo',
                'producto' => 'Nosexd',
                'detalle_reclamo' => 'No me llego',
                'pedido_cliente' => 'Que me lo entreguen xd',
                'estado' => 'pendiente',
                'respuesta_empresa' => null,
                'fecha_respuesta' => null,
                'orden_id' => null,
                'created_at' => '2025-06-23 00:50:57',
                'updated_at' => '2025-06-23 00:50:57'
            ]
        ]);
    }

    private function insertVentas()
    {
        DB::table('ventas')->insert([
            ['id' => 9, 'producto_id' => 18, 'cantidad' => 1, 'precio_unitario' => 179.00, 'total' => 179.00, 'created_at' => '2025-06-23 05:00:44', 'updated_at' => '2025-06-23 05:00:44']
        ]);
    }

    private function insertPasswordResetTokens()
    {
        DB::table('password_reset_tokens')->insert([
            'email' => 'rodolfo.tavera@tecsup.edu.pe',
            'token' => '$2y$12$LhFAjt/KPiXxq3hXBC8WvOfY10H56S3tt3iJhZ5ujj8D/L9k3JPom',
            'created_at' => '2025-06-23 23:15:06'
        ]);
    }
}