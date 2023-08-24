<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\unidades;

class UnitProduccionController extends Controller
{
    public function index()
    {
        $unidades = unidades::all();
        return view('propietarios.unit', ['unidades' => $unidades]);
    }

    public function create()
    {
        return view('propietarios.createunit');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'upp' => 'required|string|max:12',
            'domicilio' => 'required|string',
            'localidad' => 'required|string',
            'municipio' => 'required|string',
            'estado' => 'required|string',
            'id_propietario' => 'required|exists:mysql.propietarios,id'
        ]);
        unidades::create($data);
        return redirect()->route('propietario.unit');
    }

    public function edit(unidades $unidad)
    {
        return view('propietarios.editUnidad');
    }

    public function update(Request $request, unidades $unidad)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'upp' => 'required|string|max:12',
            'domicilio' => 'required|string',
            'localidad' => 'required|string',
            'municipio' => 'required|string',
            'estado' => 'required|string',
            'id_prop' => 'required|exists:propietarios,id'
        ]);

        $unidad->update($data);

        return redirect()->route('unidades.index')
            ->with('success', 'Unidad de Producción actualizada exitosamente.');
    }

    public function destroy(unidades $unidad)
    {
        $unidad->delete();
        return redirect()->route('propietario.unit')->with('success', 'Unidad de Producción eliminada exitosamente.');
    }
}
