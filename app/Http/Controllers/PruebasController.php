<?php

namespace App\Http\Controllers;
use App\Models\Prueba;
use App\Models\Bovino;
use App\Models\Detalle;

use Illuminate\Http\Request;

class PruebasController extends Controller
{
    public function index()
    {
        $pruebas = Prueba::all();
        return view('pruebas.pruebas', compact('pruebas'));
    }

    public function create()
    {
        return view('pruebas.registrar');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'tipo' => 'required|string',
            'descripcion' => 'required|string',
            'inyeccion' => 'required|date',
            'lectura' => 'required|date',
            'no_animales' => 'required|integer',
            'id_propietario' => 'required|integer',
        ]);
        $prueba = Prueba::create($data);
        return redirect()->route('pruebas.bovinos', ['id' => $prueba->id])->with('success', 'Prueba creada exitosamente.');
    }

    public function edit(Prueba $prueba)
    {
        $detalles = $prueba->detalles;
        $bovinoIds = $detalles->pluck('id_bovino')->toArray();
        $bovinos = Bovino::whereIn('id', $bovinoIds)->get();
        return view('pruebas.edit', compact('prueba', 'bovinos'));
    }

    public function destroy(Prueba $prueba)
    {
        $detalles = Detalle::where('id_prueba', $prueba->id)->get();
        foreach ($prueba->detalles as $detalle) {
            $detalle->delete();
        }
        $prueba->delete();
        return redirect()->route('pruebas.pruebas')->with('success', 'Prueba y sus detalles eliminados exitosamente.');
    }

    public function nombreDelMetodo($id)
    {
        $bovinos = Bovino::all();
        return view('pruebas.bovinos', ['id' => $id, 'bovinos' => $bovinos]);
    }

    public function agregarDetalles(Request $request) {
        $bovinosSeleccionados = $request->input('bovinos_seleccionados', []);
        $idPrueba = $request->input('id_prueba');
        $cantidadBovinosSeleccionados = count($bovinosSeleccionados);
        $prueba = Prueba::find($idPrueba);
        $prueba->no_animales = $cantidadBovinosSeleccionados;
        $prueba->save();
        foreach ($bovinosSeleccionados as $bovinoId) {
            Detalle::create([
                'id_bovino' => $bovinoId,
                'id_prueba' => $idPrueba,
                'resultado' => "N/A",
            ]);
        }
        return redirect()->route('pruebas.pruebas')->with('success', 'Detalles agregados correctamente');
    }

    public function update(Request $request, Prueba $prueba) {
        if ($prueba->id_propietario != auth()->user()->id) {
            return redirect()->route('pruebas.pruebas')->with('error', 'No tienes permisos para editar esta prueba.');
        }
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'inyeccion' => 'required|date',
            'lectura' => 'required|date',
            'descripcion' => 'required|string',
        ]);
        $prueba->update($validatedData);
        $resultados = $request->input('resultado');
        foreach ($resultados as $bovinoId => $resultado) {
            $detalle = Detalle::where('id_bovino', $bovinoId)->first();
            if ($detalle) {
                $detalle->resultado = $resultado;
                $detalle->save();
            }
        }
        return redirect()->route('pruebas.pruebas')->with('success', 'Prueba actualizada exitosamente.');
    }
}
