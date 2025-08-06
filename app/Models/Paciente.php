<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';
    protected $primaryKey = 'id_paciente';
    public $timestamps = true;
    protected $fillable = [
        'nombre',
        'apellidoP',
        'apellidoM',
        'genero',
        'fecha_nacimiento',
        'telefono',
        'correo',
        'estado',
        'domicilio'
    ];



    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_paciente');
    }

    public function recetas()
    {
        return $this->hasMany(Receta::class, 'id_paciente');
    }
}
