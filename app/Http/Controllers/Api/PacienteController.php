<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Validation\ValidationException;

class PacienteController extends Controller
{
    /**
     * Listar todos los pacientes.
     */
    public function index()
    {
        $pacientes = Paciente::with('direccion')->get();
        return response()->json($pacientes);
    }

    /**
     * Crear un nuevo paciente.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellidoP' => 'required|string|max:255',
                'apellidoM' => 'nullable|string|max:255',
                'genero' => 'required|in:M,F,O',
                'fecha_nacimiento' => 'required|date',
                'telefono' => 'nullable|string|max:20',
                'correo' => 'nullable|email|max:255',
                'id_direccion' => 'nullable|exists:direcciones,id_direccion'
            ]);

            $paciente = Paciente::create($validated);

            return response()->json([
                'message' => 'Paciente creado correctamente',
                'data' => $paciente
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Mostrar un paciente específico.
     */
    public function show(string $id)
    {
        $paciente = Paciente::with(['direccion', 'citas', 'recetas'])->find($id);

        if (!$paciente) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }

        return response()->json($paciente);
    }

    /**
     * Actualizar un paciente.
     */
    public function update(Request $request, string $id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }

        try {
            $request->merge([
                'telefono' => $request->telefono ?: null,
                'correo' => $request->correo ?: null,
            ]);

            $validated = $request->validate([
                'nombre' => 'sometimes|string|max:255',
                'apellidoP' => 'sometimes|string|max:255',
                'apellidoM' => 'sometimes|string|max:255',
                'genero' => 'sometimes|in:M,F,O',
                'fecha_nacimiento' => 'sometimes|date',
                'estado' => 'sometimes|string|max:255',
                'telefono' => 'nullable|string|max:20',
                'correo' => 'nullable|email|max:255',
                'id_direccion' => 'sometimes|exists:direcciones,id_direccion'
            ]);

            $paciente->update($validated);

            return response()->json([
                'message' => 'Paciente actualizado correctamente',
                'data' => $paciente
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Contar pacientes activos.
     */
    public function countActivePatients()
    {
        $count = Paciente::where('estado', 'activo')->count();
        return response()->json(['activos' => $count]);
    }

    /**
     * Contar pacientes inactivos.
     */
    public function countInactivePatients()
    {
        $count = Paciente::where('estado', 'inactivo')->count();
        return response()->json(['inactivos' => $count]);
    }



    /**
     * Eliminar un paciente.
     */
    public function destroy(string $id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }

        $paciente->delete();

        return response()->json(['message' => 'Paciente eliminado correctamente']);
    }

    public function pacientesConUltimosDatos()
    {
        $pacientes = Paciente::select(
            'id_paciente',
            'nombre',
            'apellidoP',
            'apellidoM',
            'created_at',
            'estado',
            'genero',
            'fecha_nacimiento'
        )
            ->with([
                'citas' => function ($query) {
                    $query->latest('created_at')->limit(1);
                },
                'recetas' => function ($query) {
                    $query->latest('created_at')->limit(1);
                }
            ])
            ->get()
            ->map(function ($paciente) {
                return [
                    'id_paciente' => $paciente->id_paciente,
                    'nombre' => $paciente->nombre,
                    'apellidoP' => $paciente->apellidoP,
                    'apellidoM' => $paciente->apellidoM,
                    'estado' => $paciente->estado,
                    'created_at' => $paciente->created_at,
                    'genero' => $paciente->genero,
                    'fecha_nacimiento' => $paciente->fecha_nacimiento,
                    'ultima_cita' => optional($paciente->citas->first())->created_at,
                    'ultima_receta' => optional($paciente->recetas->first())->created_at,
                ];
            });

        return response()->json($pacientes);
    }
}
