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
    Schema::create('ordenes', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('apellidos');
        $table->string('dni');
        $table->string('region');
        $table->string('distrito');
        $table->string('direccion')->nullable();
        $table->string('departamento')->nullable();
        $table->string('telefono');
        $table->string('email');
        $table->text('notas')->nullable();
        $table->decimal('monto_total', 8, 2);
        $table->string('estado_pago')->default('pendiente');
        $table->string('paypal_order_id')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
