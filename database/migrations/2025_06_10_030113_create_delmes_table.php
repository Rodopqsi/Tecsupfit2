<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delmes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('marca');
            $table->text('descripcion')->nullable();
            $table->decimal('precio_original', 10, 2);
            $table->decimal('precio_oferta', 10, 2);
            $table->integer('stock')->default(0);
            $table->enum('categoria', [
                'keratinas', 
                'proteinas', 
                'ganadores_peso', 
                'quemadores_grasa', 
                'barras_energeticas', 
                'vitaminas_otros'
            ]);
            $table->string('imagen')->nullable();
            $table->boolean('activo')->default(true);
            $table->boolean('destacado')->default(false);
            $table->timestamps();
            
            // Índices para mejor rendimiento
            $table->index('categoria');
            $table->index('activo');
            $table->index('destacado');
            $table->index(['categoria', 'activo', 'destacado']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delmes');
    }
};
