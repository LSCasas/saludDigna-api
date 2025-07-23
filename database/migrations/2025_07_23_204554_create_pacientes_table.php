<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id('id_paciente');
            $table->string('nombre');
            $table->string('apellidoP');
            $table->string('apellidoM');
            $table->string('genero', 10);
            $table->date('fecha_nacimiento');
            $table->string('estado')->default('activo');
            $table->string('telefono')->nullable();
            $table->string('correo')->unique()->nullable();
            $table->foreignId('id_direccion')->nullable()->references('id_direccion')->on('direcciones')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
