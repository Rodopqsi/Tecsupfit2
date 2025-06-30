<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cupones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->decimal('descuento', 8, 2);
            $table->enum('tipo_descuento', ['fijo', 'porcentaje'])->default('fijo');
            $table->integer('stock')->default(0);
            $table->decimal('precio_minimo', 8, 2)->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cupones');
    }
};