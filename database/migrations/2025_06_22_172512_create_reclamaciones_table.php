<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reclamaciones', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_documento', ['dni', 'ce', 'pasaporte', 'ruc']);
            $table->string('numero_documento', 20);
            $table->string('telefono', 15);
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('email', 100);
            $table->text('direccion');
            $table->date('fecha_compra')->nullable();
            $table->enum('tipo_reclamo', ['reclamo', 'queja']);
            $table->string('producto', 100)->nullable(); 
            $table->text('detalle_reclamo');
            $table->text('pedido_cliente');
            $table->enum('estado', ['pendiente', 'en_proceso', 'resuelto', 'cerrado'])->default('pendiente');
            $table->text('respuesta_empresa')->nullable();
            $table->timestamp('fecha_respuesta')->nullable();
            $table->foreignId('orden_id')->nullable()->constrained('ordenes')->onDelete('set null');
            $table->timestamps();

            $table->index(['estado', 'created_at']);
            $table->index('numero_documento');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reclamaciones');
    }
};
