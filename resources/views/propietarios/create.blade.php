@extends('layouts.app')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
        <div class="text-center white-text mx-5 wow fadeIn">
            <div class="container">
                <h1 class="mb-4">
                    <strong>REGISTRAR</strong>
                </h1>
                <form action="{{ route('propietarios.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="text" placeholder="Nombre" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
                    <input type="text" placeholder="Apellido Paterno" name="apellido_paterno" id="apellido_paterno" value="{{ old('apellido_paterno') }}" required>
                    <input type="text" placeholder="Apellido Materno" name="apellido_materno" id="apellido_materno" value="{{ old('apellido_materno') }}">
                    <input type="text" placeholder="Numero" name="numero" id="numero" value="{{ old('numero') }}" required>
                    <input type="text" placeholder="Domicilio" name="domicilio" id="domicilio" value="{{ old('domicilio') }}" required>
                    <input type="text" placeholder="Localidad" name="localidad" id="localidad" value="{{ old('localidad') }}" required>
                    <input type="text" placeholder="Municipio" name="municipio" id="municipio" value="{{ old('municipio') }}" required>
                    <input type="text" placeholder="Estado" name="estado" id="estado" value="{{ old('estado') }}" required>
                    <input type="text" placeholder="Correo" name="correo" id="correo" value="{{ old('correo') }}" required>
                    <input type="password" placeholder="Contraseña" name="password" id="password" required>
                    <button type="submit" class="button">Registrar</button><br><br>
                </form>  
            </div>
        </div>
    </div>
@endsection