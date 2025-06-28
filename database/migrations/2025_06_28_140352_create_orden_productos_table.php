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
    Schema::create('orden_productos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('orden_id');
        $table->unsignedBigInteger('producto_id'); // ← Esta columna es la que falta
        $table->integer('cantidad');
        $table->decimal('precio_unitario', 8, 2);
        $table->timestamps();

        // Claves foráneas si deseas
        $table->foreign('orden_id')->references('id')->on('ordenes')->onDelete('cascade');
        $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_productos');
    }
};