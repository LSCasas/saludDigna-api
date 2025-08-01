<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';
    protected $primaryKey = 'id_cita';
    protected $fillable = ['id_paciente', 'fecha_cita', 'hora_cita', 'motivo', 'estado', 'nota'];
    public $timestamps = true;

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }
}
