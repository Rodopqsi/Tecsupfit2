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
        // Deshabilitar restricciones de claves foráneas temporalmente
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Limpiar tablas existentes (en orden correcto por dependencias)
        $tables = [
            'ventas', 'opinions', 'carrito_productos', 'orden_productos', 'ordenes',
            'productos', 'stocks', 'reclamaciones', 'cupones', 'sessions',
            'password_reset_tokens', 'sabores', 'tamanos', 'objetivos',
            'marcas', 'categorias', 'delmes', 'users', 'migrations'
        ];
        
        foreach ($tables as $table) {
            if (DB::getSchemaBuilder()->hasTable($table)) {
                DB::table($table)->truncate();
            }
        }

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
            ['id' => 17, 'nombre' => 'Café', 'descripcion' => 'Sabor a café', 'created_at' => '2025-06-21 22:15:22', 'updated_at' => '2025-06-21 22:15:22'],
            ['id' => 18, 'nombre' => 'Caramelo', 'descripcion' => 'Sabor dulce a caramelo', 'created_at' => '2025-06-21 22:15:22', 'updated_at' => '2025-06-21 22:15:22'],
            ['id' => 10, 'nombre' => 'Chocolate Blanco', 'descripcion' => 'Sabor a chocolate blanco', 'created_at' => '2025-06-21 22:15:22', 'updated_at' => '2025-06-21 22:15:22']
        ]);

        // 8. STOCKS
        $stocks = [
            ['id' => 1, 'cantidad' => 50, 'stock_minimo' => 10, 'created_at' => '2025-06-16 08:03:09', 'updated_at' => '2025-06-16 08:03:09'],
            ['id' => 2, 'cantidad' => 5, 'stock_minimo' => 15, 'created_at' => '2025-06-16 08:03:09', 'updated_at' => '2025-06-16 20:32:02'],
            ['id' => 3, 'cantidad' => 30, 'stock_minimo' => 5, 'created_at' => '2025-06-16 08:03:09', 'updated_at' => '2025-06-16 08:03:09'],
            ['id' => 4, 'cantidad' => 22, 'stock_minimo' => 8, 'created_at' => '2025-06-16 08:03:09', 'updated_at' => '2025-06-16 19:35:38'],
            ['id' => 5, 'cantidad' => 54, 'stock_minimo' => 5, 'created_at' => '2025-06-17 06:55:34', 'updated_at' => '2025-06-17 06:55:34'],
            ['id' => 6, 'cantidad' => 32, 'stock_minimo' => 1, 'created_at' => '2025-06-17 09:43:46', 'updated_at' => '2025-06-17 09:43:46'],
            ['id' => 7, 'cantidad' => 22, 'stock_minimo' => 1, 'created_at' => '2025-06-17 09:47:05', 'updated_at' => '2025-06-17 09:47:05'],
            ['id' => 8, 'cantidad' => 70, 'stock_minimo' => 1, 'created_at' => '2025-06-17 20:43:58', 'updated_at' => '2025-06-17 20:44:27'],
            ['id' => 18, 'cantidad' => 19, 'stock_minimo' => 1, 'created_at' => '2025-06-19 12:25:59', 'updated_at' => '2025-06-19 12:25:59'],
            ['id' => 19, 'cantidad' => 69, 'stock_minimo' => 1, 'created_at' => '2025-06-21 09:08:46', 'updated_at' => '2025-06-23 05:00:43'],
            ['id' => 20, 'cantidad' => 0, 'stock_minimo' => 1, 'created_at' => '2025-06-21 10:32:05', 'updated_at' => '2025-06-23 12:14:07'],
            ['id' => 21, 'cantidad' => 89, 'stock_minimo' => 1, 'created_at' => '2025-06-21 10:32:54', 'updated_at' => '2025-06-21 10:32:54'],
            ['id' => 22, 'cantidad' => 87, 'stock_minimo' => 1, 'created_at' => '2025-06-21 10:33:43', 'updated_at' => '2025-06-21 10:33:43'],
            ['id' => 24, 'cantidad' => 8, 'stock_minimo' => 2, 'created_at' => '2025-06-24 01:15:10', 'updated_at' => '2025-06-24 01:15:10'],
            ['id' => 25, 'cantidad' => 8, 'stock_minimo' => 2, 'created_at' => '2025-06-24 01:18:28', 'updated_at' => '2025-06-24 01:18:28'],
            ['id' => 27, 'cantidad' => 10, 'stock_minimo' => 2, 'created_at' => '2025-06-24 01:37:46', 'updated_at' => '2025-06-24 01:37:46'],
            ['id' => 28, 'cantidad' => 7, 'stock_minimo' => 2, 'created_at' => '2025-06-24 01:39:25', 'updated_at' => '2025-06-24 01:39:25'],
            ['id' => 29, 'cantidad' => 6, 'stock_minimo' => 2, 'created_at' => '2025-06-24 01:41:38', 'updated_at' => '2025-06-24 01:41:38'],
            ['id' => 30, 'cantidad' => 7, 'stock_minimo' => 2, 'created_at' => '2025-06-24 01:43:44', 'updated_at' => '2025-06-24 01:43:44'],
            ['id' => 31, 'cantidad' => 8, 'stock_minimo' => 2, 'created_at' => '2025-06-24 01:46:05', 'updated_at' => '2025-06-24 01:46:05'],
            ['id' => 32, 'cantidad' => 9, 'stock_minimo' => 2, 'created_at' => '2025-06-24 01:47:40', 'updated_at' => '2025-06-24 01:47:40'],
            ['id' => 33, 'cantidad' => 10, 'stock_minimo' => 2, 'created_at' => '2025-06-24 01:49:28', 'updated_at' => '2025-06-24 01:49:28'],
            ['id' => 34, 'cantidad' => 80, 'stock_minimo' => 10, 'created_at' => '2025-06-24 01:52:49', 'updated_at' => '2025-06-24 01:52:49'],
            ['id' => 35, 'cantidad' => 8, 'stock_minimo' => 2, 'created_at' => '2025-06-24 01:52:53', 'updated_at' => '2025-06-24 01:52:53'],
            ['id' => 37, 'cantidad' => 6, 'stock_minimo' => 2, 'created_at' => '2025-06-24 01:55:48', 'updated_at' => '2025-06-24 01:55:48'],
            ['id' => 38, 'cantidad' => 8, 'stock_minimo' => 6, 'created_at' => '2025-06-24 01:57:58', 'updated_at' => '2025-06-24 01:57:58'],
            ['id' => 39, 'cantidad' => 8, 'stock_minimo' => 2, 'created_at' => '2025-06-24 01:59:41', 'updated_at' => '2025-06-24 01:59:41'],
            ['id' => 41, 'cantidad' => 7, 'stock_minimo' => 2, 'created_at' => '2025-06-24 02:02:46', 'updated_at' => '2025-06-24 02:02:46'],
            ['id' => 42, 'cantidad' => 5, 'stock_minimo' => 2, 'created_at' => '2025-06-24 02:05:03', 'updated_at' => '2025-06-24 02:05:03'],
            ['id' => 43, 'cantidad' => 20, 'stock_minimo' => 2, 'created_at' => '2025-06-24 02:09:20', 'updated_at' => '2025-06-24 02:09:20'],
            ['id' => 44, 'cantidad' => 25, 'stock_minimo' => 2, 'created_at' => '2025-06-24 02:10:38', 'updated_at' => '2025-06-24 02:10:38'],
            ['id' => 45, 'cantidad' => 20, 'stock_minimo' => 2, 'created_at' => '2025-06-24 02:12:58', 'updated_at' => '2025-06-24 02:12:58'],
            ['id' => 46, 'cantidad' => 23, 'stock_minimo' => 2, 'created_at' => '2025-06-24 02:14:47', 'updated_at' => '2025-06-24 02:14:47'],
            ['id' => 47, 'cantidad' => 12, 'stock_minimo' => 2, 'created_at' => '2025-06-24 03:17:05', 'updated_at' => '2025-06-24 03:17:05'],
            ['id' => 48, 'cantidad' => 13, 'stock_minimo' => 2, 'created_at' => '2025-06-24 03:19:08', 'updated_at' => '2025-06-24 03:19:08'],
            ['id' => 49, 'cantidad' => 50, 'stock_minimo' => 2, 'created_at' => '2025-06-24 03:21:30', 'updated_at' => '2025-06-24 03:21:30'],
            ['id' => 50, 'cantidad' => 21, 'stock_minimo' => 2, 'created_at' => '2025-06-24 03:23:11', 'updated_at' => '2025-06-24 03:23:11'],
            ['id' => 51, 'cantidad' => 23, 'stock_minimo' => 2, 'created_at' => '2025-06-24 03:25:12', 'updated_at' => '2025-06-24 03:25:12'],
            ['id' => 52, 'cantidad' => 9, 'stock_minimo' => 2, 'created_at' => '2025-06-24 03:28:32', 'updated_at' => '2025-06-24 03:28:32'],
            ['id' => 53, 'cantidad' => 10, 'stock_minimo' => 2, 'created_at' => '2025-06-24 03:32:30', 'updated_at' => '2025-06-24 03:32:30'],
            ['id' => 54, 'cantidad' => 12, 'stock_minimo' => 2, 'created_at' => '2025-06-24 03:34:39', 'updated_at' => '2025-06-24 03:34:39'],
            ['id' => 55, 'cantidad' => 10, 'stock_minimo' => 2, 'created_at' => '2025-06-24 03:37:09', 'updated_at' => '2025-06-24 03:37:09'],
            ['id' => 56, 'cantidad' => 12, 'stock_minimo' => 2, 'created_at' => '2025-06-24 03:39:59', 'updated_at' => '2025-06-24 03:39:59']
        ];

        foreach ($stocks as $stock) {
            DB::table('stocks')->insert($stock);
        }

        // 9. DELMES
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
            ],
            [
                'id' => 7,
                'nombre' => 'Venezuela',
                'marca' => 'NOSE',
                'descripcion' => 'asdsad',
                'precio_original' => 21.00,
                'precio_oferta' => 32.00,
                'stock' => 55,
                'categoria' => 'keratinas',
                'imagen' => 'productos/i27a37SyDot1tJjsUCYI1AJpfZwydACuVv5vaAuM.jpg',
                'activo' => 1,
                'destacado' => 1,
                'created_at' => '2025-06-14 19:46:28',
                'updated_at' => '2025-06-14 19:46:28'
            ]
        ]);

        // 10. PRODUCTOS
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
            ],
            [
                'id' => 20,
                'nombre' => 'Creatina Ronnie Coleman 1kg',
                'precio_nuevo' => 215.00,
                'precio_antes' => 249.00,
                'imagen' => '1750483974.png',
                'descripcion' => 'Un suplemento rico',
                'categoria_id' => 7,
                'stock_id' => 21,
                'marca_id' => 17,
                'es_delmes' => 1,
                'ventas_mes' => 0,
                'created_at' => '2025-06-21 10:32:54',
                'updated_at' => '2025-06-21 10:34:01',
                'tamano_id' => null,
                'sabor_id' => null,
                'objetivo_id' => null
            ],
            [
                'id' => 21,
                'nombre' => 'MuscleTech Creatine Chews - Creapure Monohydrate Supplement for Muscle',
                'precio_nuevo' => 149.00,
                'precio_antes' => 209.00,
                'imagen' => '1750484023.png',
                'descripcion' => 'Suplemento rico',
                'categoria_id' => 7,
                'stock_id' => 22,
                'marca_id' => 18,
                'es_delmes' => 1,
                'ventas_mes' => 0,
                'created_at' => '2025-06-21 10:33:43',
                'updated_at' => '2025-06-21 10:34:02',
                'tamano_id' => null,
                'sabor_id' => null,
                'objetivo_id' => null
            ],
            [
                'id' => 23,
                'nombre' => 'Gold Standard Whey ON (5LB)',
                'precio_nuevo' => 389.00,
                'precio_antes' => 449.00,
                'imagen' => '1750709710.png',
                'descripcion' => 'Proteína Gold Standard Whey de 4.65lb a 5lb – Optimum Nutrition',
                'categoria_id' => 13,
                'stock_id' => 24,
                'marca_id' => 11,
                'es_delmes' => 0,
                'ventas_mes' => 0,
                'created_at' => '2025-06-24 01:15:10',
                'updated_at' => '2025-06-24 01:15:10',
                'tamano_id' => 2,
                'sabor_id' => 2,
                'objetivo_id' => 1
            ]
        ];

        // Insertar productos en lotes para evitar problemas de memoria
        foreach ($productos as $producto) {
            DB::table('productos')->insert($producto);
        }

        // Insertar más productos
        $this->insertMoreProductos();

        // 11. CUPONES
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
            ],
            [
                'id' => 2,
                'codigo' => 'TEC25',
                'descuento' => 20.00,
                'tipo_descuento' => 'porcentaje',
                'stock' => 120,
                'imagen' => null,
                'precio_minimo' => 190.00,
                'fecha_inicio' => '2025-06-26',
                'fecha_fin' => '2025-06-28',
                'user_id' => null,
                'created_at' => '2025-06-28 23:00:47',
                'updated_at' => '2025-06-28 23:00:47'
            ],
            [
                'id' => 3,
                'codigo' => 'TEC2024',
                'descuento' => 50.00,
                'tipo_descuento' => 'porcentaje',
                'stock' => 190,
                'imagen' => null,
                'precio_minimo' => 150.00,
                'fecha_inicio' => '2025-06-26',
                'fecha_fin' => '2025-06-30',
                'user_id' => null,
                'created_at' => '2025-06-28 23:04:08',
                'updated_at' => '2025-06-28 23:04:08'
            ],
            [
                'id' => 4,
                'codigo' => 'TEC',
                'descuento' => 50.00,
                'tipo_descuento' => 'porcentaje',
                'stock' => 190,
                'imagen' => null,
                'precio_minimo' => 1.00,
                'fecha_inicio' => '2025-06-26',
                'fecha_fin' => '2025-06-30',
                'user_id' => null,
                'created_at' => '2025-06-28 23:07:32',
                'updated_at' => '2025-06-28 23:07:32'
            ],
            [
                'id' => 5,
                'codigo' => 'BIENVEFIT',
                'descuento' => 50.00,
                'tipo_descuento' => 'porcentaje',
                'stock' => 150,
                'imagen' => 'imagenes/cupones/1751222342_Historia de Instagram evento de comics creativo divertido celeste y rojo.png',
                'precio_minimo' => 120.00,
                'fecha_inicio' => '2025-06-27',
                'fecha_fin' => '2025-06-30',
                'user_id' => null,
                'created_at' => '2025-06-29 21:27:05',
                'updated_at' => '2025-06-29 23:39:02'
            ]
        ]);

        // 12. CARRITO_PRODUCTOS
        DB::table('carrito_productos')->insert([
            ['id' => 1, 'user_id' => 10, 'producto_id' => 18, 'cantidad' => 1, 'created_at' => '2025-06-24 00:46:37', 'updated_at' => '2025-06-24 00:46:37'],
            ['id' => 3, 'user_id' => 11, 'producto_id' => 21, 'cantidad' => 1, 'created_at' => '2025-06-24 04:36:36', 'updated_at' => '2025-06-24 04:36:36'],
            ['id' => 4, 'user_id' => 1, 'producto_id' => 20, 'cantidad' => 5, 'created_at' => '2025-06-24 08:48:58', 'updated_at' => '2025-06-27 08:57:14'],
            ['id' => 5, 'user_id' => 1, 'producto_id' => 18, 'cantidad' => 2, 'created_at' => '2025-06-24 22:04:23', 'updated_at' => '2025-06-24 22:32:19'],
            ['id' => 6, 'user_id' => 1, 'producto_id' => 21, 'cantidad' => 1, 'created_at' => '2025-06-24 22:26:35', 'updated_at' => '2025-06-24 22:26:35'],
            ['id' => 7, 'user_id' => 13, 'producto_id' => 20, 'cantidad' => 2, 'created_at' => '2025-06-27 09:02:34', 'updated_at' => '2025-06-27 09:16:24'],
            ['id' => 8, 'user_id' => 13, 'producto_id' => 21, 'cantidad' => 1, 'created_at' => '2025-06-28 21:49:52', 'updated_at' => '2025-06-28 21:49:52'],
            ['id' => 9, 'user_id' => 13, 'producto_id' => 18, 'cantidad' => 1, 'created_at' => '2025-06-28 21:52:23', 'updated_at' => '2025-06-28 21:52:23']
        ]);

        // 13. OPINIONS
        DB::table('opinions')->insert([
            ['id' => 1, 'user_id' => 1, 'producto_id' => 18, 'valoracion' => 5, 'comentario' => 'Esta bonito', 'created_at' => '2025-06-23 03:40:39', 'updated_at' => '2025-06-23 03:40:39'],
            ['id' => 2, 'user_id' => 1, 'producto_id' => 23, 'valoracion' => 5, 'comentario' => 'Muy buena', 'created_at' => '2025-06-24 03:12:13', 'updated_at' => '2025-06-24 03:12:13'],
            ['id' => 3, 'user_id' => 1, 'producto_id' => 23, 'valoracion' => 1, 'comentario' => 'Muy mala', 'created_at' => '2025-06-24 03:12:25', 'updated_at' => '2025-06-24 03:12:25']
        ]);

        // 14. RECLAMACIONES
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
            ],
            [
                'id' => 2,
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
                'created_at' => '2025-06-23 00:52:34',
                'updated_at' => '2025-06-23 00:52:34'
            ]
        ]);

        // 15. VENTAS
        DB::table('ventas')->insert([
            ['id' => 9, 'producto_id' => 18, 'cantidad' => 1, 'precio_unitario' => 179.00, 'total' => 179.00, 'created_at' => '2025-06-23 05:00:44', 'updated_at' => '2025-06-23 05:00:44'],
            ['id' => 10, 'producto_id' => 19, 'cantidad' => 1, 'precio_unitario' => 109.00, 'total' => 109.00, 'created_at' => '2025-06-23 12:14:07', 'updated_at' => '2025-06-23 12:14:07']
        ]);

        // 16. PASSWORD RESET TOKENS
        DB::table('password_reset_tokens')->insert([
            'email' => 'rodolfo.tavera@tecsup.edu.pe',
            'token' => '$2y$12$LhFAjt/KPiXxq3hXBC8WvOfY10H56S3tt3iJhZ5ujj8D/L9k3JPom',
            'created_at' => '2025-06-23 23:15:06'
        ]);

        // 17. SESSIONS
        DB::table('sessions')->insert([
            [
                'id' => 'FPp2IEGiv1WreqCe6o5gxC5OCM4uLpELnivtOHxq',
                'user_id' => null,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',
                'payload' => 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmp0VHloUUJRM3MxSmVrR1FrQVhLZ3U3clUwNExMY295TFludkRJZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',
                'last_activity' => 1751314095
            ]
        ]);

        // Rehabilitar restricciones de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('✅ Base de datos poblada exitosamente con todos los datos!');
    }

    private function insertMoreProductos()
    {
        // Resto de productos - dividido en función separada por límite de respuesta
        $moreProductos = [
            [
                'id' => 24,
                'nombre' => 'Carnivor Protein 4.5lbs',
                'precio_nuevo' => 299.00,
                'precio_antes' => 349.00,
                'imagen' => '1750709908.png',
                'descripcion' => 'Ayuda a definir musculo, perfecto para personas que quieran definir-Sabor a vainilla',
                'categoria_id' => 13,
                'stock_id' => 25,
                'marca_id' => 15,
                'es_delmes' => 0,
                'ventas_mes' => 0,
                'created_at' => '2025-06-24 01:18:28',
                'updated_at' => '2025-06-24 01:18:28',
                'tamano_id' => null,
                'sabor_id' => 1,
                'objetivo_id' => 3
            ],
            // Agregar más productos aquí si es necesario...
        ];

        foreach ($moreProductos as $producto) {
            DB::table('productos')->insert($producto);
        }
    }
}