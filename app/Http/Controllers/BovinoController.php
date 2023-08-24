<?php

namespace App\Http\Controllers;
use App\Models\Propietario;
use App\Models\Bovino;
use TensorFlow\Graph;
use TensorFlow\Tensor;

use Illuminate\Http\Request;

class BovinoController extends Controller
{
    protected $connection = 'mysql_secondary';
    public function create()
    {
        $propietarios = Propietario::all();
        return view('bovinos.create', compact('propietarios'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_coqueta' => 'required|unique:mysql_secondary.bovinos',
            'nombre' => 'required',
            'raza' => 'required',   
            'sexo' => 'required',
            'tipo' => 'required',
            'fecha_nacimiento' => 'required|date',
            'id_propietario' => 'required|exists:mysql.propietarios,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Calcula la edad en meses
        $fechaNacimiento = new \DateTime($request->fecha_nacimiento);
        $hoy = new \DateTime();
        $edadEnMeses = $fechaNacimiento->diff($hoy)->format('%y') * 12 + $fechaNacimiento->diff($hoy)->format('%m');
        // Validar si es macho no puede ser vientre o vaquilla y si es hembra no puede ser Semental o Novillo
        if (($request->sexo === 'Macho' && in_array($request->tipo, ['Vientre', 'Vaquilla'])) ||
            ($request->sexo === 'Hembra' && in_array($request->tipo, ['Semental', 'Novillo']))) {
            return redirect()->back()->withInput()->with('error', 'Combinación de sexo y tipo no válida.');
        }
        // Validar que un bovino no pueda ser semental ni vaquilla si tiene menos de 12 meses
        if ($edadEnMeses < 12 && in_array($request->tipo, ['Semental', 'Vaquilla', 'Vientre'])) {
            return redirect()->back()->withInput()->with('error', 'Un bovino no puede ser semental ni vaquilla si tiene menos de 12 meses.');
        }
        // Validar que un bovino no pueda ser diferente a cria si tiene menos de 12 meses
        if ($edadEnMeses < 12 && $request->tipo !== 'Cria') {
            return redirect()->back()->withInput()->with('error', 'Un bovino con menos de 12 meses debe ser tipo "Cria".');
        }
        $validatedData['edad'] = $edadEnMeses;
        // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('bovinos', 'public');
            $validatedData['foto'] = $imagePath;
        }
        // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        Bovino::create($validatedData);
        return redirect()->route('bovinos.bovinos');
    }

    public function edit(Bovino $bovino)
    {
        return view('bovinos.edit', compact('bovino'));
    }

    public function update(Request $request, Bovino $bovino)
    {
        $validatedData = $request->validate([
            'no_coqueta' => "required|unique:mysql_secondary.bovinos,no_coqueta,$bovino->id",
            'nombre' => 'required',
            'raza' => 'required',
            'sexo' => 'required',
            'tipo' => 'required',
            'fecha_nacimiento' => 'required|date',
            'id_propietario' => 'required|exists:mysql.propietarios,id',
            'fierro' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Calcula la edad en meses
        $fechaNacimiento = new \DateTime($request->fecha_nacimiento);
        $hoy = new \DateTime();
        $edadEnMeses = $fechaNacimiento->diff($hoy)->format('%y') * 12 + $fechaNacimiento->diff($hoy)->format('%m');

        // Validaciones similares a las de la función store
        // ...

        $validatedData['edad'] = $edadEnMeses;

        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('bovinos', 'public');
            $validatedData['foto'] = $imagePath;
        }

        $bovino->update($validatedData);

        return redirect()->route('bovinos.bovinos')->with('success', 'Bovino actualizado exitosamente.');
    }

    public function destroy(Bovino $bovino)
    {
        try {
            $imagenNombre = $bovino->foto;
            $bovino->delete();
            if ($imagenNombre && \Illuminate\Support\Facades\Storage::disk('public')->exists($imagenNombre)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($imagenNombre);
            }
            return redirect()->route('bovinos.bovinos')->with('success', 'Bovino eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('bovinos.bovinos')->with('error', 'No se pudo eliminar el bovino. Error: ' . $e->getMessage());
        }
    }

    public function show(){
        $bovinos = Bovino::all();
        return view('bovinos.bovinos', compact('bovinos'));
    }
}
