<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            if (!Schema::hasColumn('productos', 'tamano_id')) {
                $table->foreignId('tamano_id')->nullable()->constrained('tamanos')->onDelete('set null')->after('descripcion');
            }

            if (!Schema::hasColumn('productos', 'sabor_id')) {
                $table->foreignId('sabor_id')->nullable()->constrained('sabores')->onDelete('set null')->after('tamano_id');
            }

            if (!Schema::hasColumn('productos', 'objetivo_id')) {
                $table->foreignId('objetivo_id')->nullable()->constrained('objetivos')->onDelete('set null')->after('sabor_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            if (Schema::hasColumn('productos', 'objetivo_id')) {
                $table->dropForeign(['objetivo_id']);
                $table->dropColumn('objetivo_id');
            }

            if (Schema::hasColumn('productos', 'sabor_id')) {
                $table->dropForeign(['sabor_id']);
                $table->dropColumn('sabor_id');
            }

            if (Schema::hasColumn('productos', 'tamano_id')) {
                $table->dropForeign(['tamano_id']);
                $table->dropColumn('tamano_id');
            }
        });
    }
};
