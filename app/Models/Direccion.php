<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $primaryKey = 'id_direccion';

    protected $fillable = [
        'calle',
        'numeroExterior',
        'numeroInterior',
        'colonia',
        'ciudad',
        'estado',
        'codigo_postal'
    ];

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'id_direccion');
    }
}
