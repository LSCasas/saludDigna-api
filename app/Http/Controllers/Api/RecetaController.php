<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receta;
use Illuminate\Support\Facades\Validator;

class RecetaController extends Controller
{
    /**
     * Listar todas las recetas.
     */
    public function index()
    {
        $recetas = Receta::with('paciente')->get();
        return response()->json($recetas, 200);
    }

    /**
     * Guardar una nueva receta.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_paciente' => 'required|integer|exists:pacientes,id_paciente',
            'fecha_receta' => 'required|date',
            'diagnostico' => 'required|string',
            'tension_arterial' => 'nullable|string',
            'frecuencia_cardiaca' => 'nullable|string',
            'frecuencia_respiratoria' => 'nullable|string',
            'temperatura' => 'nullable|string',
            'peso' => 'nullable|string',
            'talla' => 'nullable|string',
            'edad' => 'nullable|integer',
            'alergia' => 'nullable|string',

            'indicaciones' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $receta = Receta::create($validator->validated());
        return response()->json($receta, 201);
    }

    /**
     * Mostrar una receta específica.
     */
    public function show($id)
    {
        $receta = Receta::with('paciente')->find($id);

        if (!$receta) {
            return response()->json(['message' => 'Receta no encontrada'], 404);
        }

        return response()->json($receta, 200);
    }

    /**
     * Actualizar una receta.
     */
    public function update(Request $request, $id)
    {
        $receta = Receta::find($id);
        if (!$receta) {
            return response()->json(['message' => 'Receta no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_paciente' => 'sometimes|integer|exists:pacientes,id_paciente',
            'fecha_receta' => 'sometimes|date',
            'diagnostico' => 'sometimes|string',
            'tension_arterial' => 'nullable|string',
            'frecuencia_cardiaca' => 'nullable|string',
            'frecuencia_respiratoria' => 'nullable|string',
            'temperatura' => 'nullable|string',
            'peso' => 'nullable|string',
            'talla' => 'nullable|string',
            'edad' => 'nullable|integer',
            'alergia' => 'nullable|string',

            'indicaciones' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $receta->update($validator->validated());
        return response()->json($receta, 200);
    }

    /**
     * Eliminar una receta.
     */
    public function destroy($id)
    {
        $receta = Receta::find($id);

        if (!$receta) {
            return response()->json(['message' => 'Receta no encontrada'], 404);
        }

        $receta->delete();
        return response()->json(['message' => 'Receta eliminada correctamente'], 200);
    }

    /**
     * Renderizar datos combinados de una receta y su paciente.
     */
    public function showRecetaWithPacienteData($id)
    {
        $receta = Receta::with('paciente')->find($id);

        if (!$receta) {
            return response()->json(['message' => 'Receta no encontrada'], 404);
        }

        return response()->json([
            'receta' => [
                'id' => $receta->id_receta,
                'fecha_receta' => $receta->fecha_receta,
                'diagnostico' => $receta->diagnostico,
                'tension_arterial' => $receta->tension_arterial,
                'frecuencia_cardiaca' => $receta->frecuencia_cardiaca,
                'frecuencia_respiratoria' => $receta->frecuencia_respiratoria,
                'temperatura' => $receta->temperatura,
                'peso' => $receta->peso,
                'talla' => $receta->talla,
                'edad' => $receta->edad,
                'alergia' => $receta->alergia,
                'indicaciones' => $receta->indicaciones,
            ],
            'paciente' => $receta->paciente
        ], 200);
    }
}
