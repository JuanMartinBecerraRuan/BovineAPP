<?php

namespace App\Http\Controllers;
use App\Models\Bovino;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficoController extends Controller
{
    public function mostrarGraficoRazas()
    {
        $imagenesAleatorias = Bovino::inRandomOrder()->limit(4)->get();
        $totalBovinos = Bovino::count();
        $machos = Bovino::where('sexo', 'Macho')->where('edad', '>', 24)->get();
        $hembras = Bovino::where('sexo', 'Hembra')->where('edad', '>', 24)->get();
        $razasCount = Bovino::select('raza', DB::raw('count(*) as count'))->groupBy('raza')->pluck('count', 'raza');
        $bovinosPorEdad = Bovino::select('edad', Bovino::raw('count(*) as total'))->groupBy('edad')->orderBy('edad')->pluck('total', 'edad')->toArray();
        $tiposDeBovinos = Bovino::select('tipo', Bovino::raw('count(*) as total'))->groupBy('tipo')->pluck('total', 'tipo')->toArray();
        return view('secret', compact('razasCount','machos', 'hembras', 'totalBovinos', 'imagenesAleatorias', 'bovinosPorEdad', 'tiposDeBovinos'));
    }
}
