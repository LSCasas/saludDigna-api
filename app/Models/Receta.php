<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $primaryKey = 'id_receta';
    protected $fillable = [
        'id_paciente',
        'fecha_receta',
        'diagnostico',
        'tension_arterial',
        'frecuencia_cardiaca',
        'frecuencia_respiratoria',
        'temperatura',
        'peso',
        'talla',
        'edad',
        'alergia',
        'identificador',
        'indicaciones'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }
}
