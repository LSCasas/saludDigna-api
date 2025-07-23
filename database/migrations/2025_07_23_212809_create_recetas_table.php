<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $withinTransaction = false;
    public function up()
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->id('id_receta');
            $table->foreignId('id_paciente')->references('id_paciente')->on('pacientes')->onDelete('restrict');
            $table->date('fecha_receta');
            $table->string('diagnostico');
            $table->string('tension_arterial')->nullable();     // T.A.
            $table->string('frecuencia_cardiaca')->nullable();     // F.C.
            $table->string('frecuencia_respiratoria')->nullable(); // F.R.
            $table->string('temperatura')->nullable();       // °C
            $table->string('peso')->nullable();              // kg
            $table->string('talla')->nullable();             // m
            $table->string('edad')->nullable();                    // años
            $table->string('alergia')->nullable();             // Alergias
            $table->string('indicaciones')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recetas');
    }
};
