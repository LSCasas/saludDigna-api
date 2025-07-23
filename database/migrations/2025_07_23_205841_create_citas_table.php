<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id('id_cita');
            $table->foreignId('id_paciente')->references('id_paciente')->on('pacientes')->onDelete('restrict');
            $table->date('fecha_cita');
            $table->time('hora_cita');
            $table->string('motivo');
            $table->string('estado')->default('pendiente');
            $table->text('nota')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
