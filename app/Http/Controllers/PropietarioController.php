<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Propietario;
use App\Models\Bovino;
use Illuminate\Support\Facades\DB;

class PropietarioController extends Controller
{
    protected $connection = 'mysql';
    public function create()
    {
        return view('propietarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'numero' => 'required|string|max:255',
            'domicilio' => 'required|string|max:255',
            'localidad' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:propietarios',
            'password' => 'required|string|min:8',
        ]);

        Propietario::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'numero' => $request->numero,
            'domicilio' => $request->domicilio,
            'localidad' => $request->localidad,
            'municipio' => $request->municipio,
            'estado' => $request->estado,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Propietario registrado exitosamente.');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('correo', 'password');  
        if (Auth::attempt($credentials)) {
            $propietario = Propietario::where('correo', $request->correo)->first();
            $imagenesAleatorias = Bovino::inRandomOrder()->limit(4)->get();
            $totalBovinos = Bovino::count();
            $machos = Bovino::where('sexo', 'Macho')->where('edad', '>', 24)->get();
            $hembras = Bovino::where('sexo', 'Hembra')->where('edad', '>', 24)->get();
            $razasCount = Bovino::select('raza', DB::raw('count(*) as count'))->groupBy('raza')->pluck('count', 'raza');
            $bovinosPorEdad = Bovino::select('edad', Bovino::raw('count(*) as total'))->groupBy('edad')->orderBy('edad')->pluck('total', 'edad')->toArray();
            $tiposDeBovinos = Bovino::select('tipo', Bovino::raw('count(*) as total'))->groupBy('tipo')->pluck('total', 'tipo')->toArray();
            return view('secret', compact('propietario','razasCount','machos', 'hembras', 'totalBovinos', 'imagenesAleatorias', 'bovinosPorEdad', 'tiposDeBovinos')); 
        }
        return redirect()->route('login')->withErrors(['correo' => 'Credenciales incorrectas.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function perfil(Propietario $propietario)
    {
        return view('propietarios.perfil', compact('propietario'));
    }

    public function edit(Propietario $propietario)
    {
        return view('propietarios.edit', compact('propietario'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'numero' => 'required|string|max:255',
            'domicilio' => 'required|string|max:255',
            'localidad' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:propietarios,correo,' . $user->id,
            'password_actual' => 'required_with:password_nueva',
            'password_nueva' => 'nullable|string|min:8',
        ]);

        if ($request->has('password_nueva') && !Hash::check($validatedData['password_actual'], $user->password)) {
            return back()->withErrors(['password_actual' => 'La contraseña actual no coincide.']);
        }

        if ($request->has('password_nueva')) {
            $validatedData['password'] = Hash::make($validatedData['password_nueva']);
        }
        unset($validatedData['password_actual']);
        unset($validatedData['password_nueva']);
        $user->update($validatedData);
        return redirect()->route('propietarios.perfil', $user)->with('success', 'Perfil actualizado exitosamente.');
    }
}
