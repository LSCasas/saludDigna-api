<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use Illuminate\Support\Facades\Validator;

class CitaController extends Controller
{
    /**
     * Mostrar todas las citas
     */
    public function index()
    {
        $citas = Cita::with('paciente')->get(); // Incluye información del paciente
        return response()->json($citas);
    }

    /**
     * Guardar una nueva cita
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required',
            'motivo' => 'required|string|max:255',
            'estado' => 'nullable|string|max:50',
            'nota' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cita = Cita::create($request->all());

        return response()->json([
            'message' => 'Cita creada exitosamente',
            'cita' => $cita
        ], 201);
    }

    /**
     * Mostrar una cita específica
     */
    public function show(string $id)
    {
        $cita = Cita::with('paciente')->find($id);

        if (!$cita) {
            return response()->json(['message' => 'Cita no encontrada'], 404);
        }

        return response()->json($cita);
    }

    /**
     * Actualizar una cita
     */
    public function update(Request $request, string $id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['message' => 'Cita no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_paciente' => 'sometimes|exists:pacientes,id_paciente',
            'fecha_cita' => 'sometimes|date',
            'hora_cita' => 'sometimes',
            'motivo' => 'sometimes|string|max:255',
            'estado' => 'nullable|string|max:50',
            'nota' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cita->update($request->all());

        return response()->json([
            'message' => 'Cita actualizada exitosamente',
            'cita' => $cita
        ]);
    }

    /**
     * Eliminar una cita
     */
    public function destroy(string $id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['message' => 'Cita no encontrada'], 404);
        }

        $cita->delete();

        return response()->json(['message' => 'Cita eliminada exitosamente']);
    }

    /**
     * Mostrar todas las citas con datos limitados del paciente
     */
    public function citaConPaciente()
    {
        $citas = Cita::with(['paciente' => function ($query) {
            $query->select('id_paciente', 'nombre', 'apellidoP', 'apellidoM');
        }])->get();

        return response()->json($citas);
    }
}
