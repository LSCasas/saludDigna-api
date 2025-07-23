<?php

namespace App\Http\Controllers\Api;

use App\Models\Direccion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DireccionController extends Controller
{

    public function index()
    {
        return response()->json(Direccion::all(), 200);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'calle' => 'required|string|max:255',
            'numeroExterior' => 'required|string|max:20',
            'numeroInterior' => 'nullable|string|max:20',
            'colonia' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
        ]);

        $direccion = Direccion::create($validated);
        return response()->json($direccion, 201);
    }


    public function show($id)
    {
        $direccion = Direccion::findOrFail($id);
        return response()->json($direccion, 200);
    }


    public function update(Request $request, $id)
    {
        $direccion = Direccion::findOrFail($id);

        $validated = $request->validate([
            'calle' => 'sometimes|string|max:255',
            'numeroExterior' => 'sometimes|string|max:20',
            'numeroInterior' => 'nullable|string|max:20',
            'colonia' => 'sometimes|string|max:255',
            'ciudad' => 'sometimes|string|max:255',
            'estado' => 'sometimes|string|max:255',
            'codigo_postal' => 'sometimes|string|max:10',
        ]);

        $direccion->update($validated);
        return response()->json($direccion, 200);
    }


    public function destroy($id)
    {
        Direccion::destroy($id);
        return response()->json(null, 204);
    }
}
