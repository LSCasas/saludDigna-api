<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direcciones';
    protected $primaryKey = 'id_direccion';
    public $timestamps = true;

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
