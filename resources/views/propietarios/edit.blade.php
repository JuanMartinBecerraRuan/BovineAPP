@extends('layouts.admin')
@section('content')
<div class="list-group list-group-flush blue-grey">
      <a href="/privada" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-chart-pie mr-3"></i>Estadisticas</a>
      <a href="/bovinos/reg" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-user mr-3"></i>Especies</a>
      <a href="/unidad_de_produccion" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-map mr-3"></i>U. de Produccion</a>
      <a href="/pruebas/pruebas" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-table mr-3"></i>Pruebas</a>
      <a href="/perfil" class="list-group-item active waves-effect white-text">
        <i class="fas fa-user mr-3"></i>Perfil</a>
    </div>
  </div>
</header>
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <div class="container">
            <h2>Edit Propietario</h2>
            <form method="POST" action="{{ route('propietario.update') }}">
                @csrf
                @method('PUT')
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', auth()->user()->nombre) }}">
                <input type="text" name="apellido_paterno" class="form-control" value="{{ old('apellido_paterno', auth()->user()->apellido_paterno) }}">
                <input type="text" name="apellido_materno" class="form-control" value="{{ old('apellido_materno', auth()->user()->apellido_materno) }}">
                <input type="text" name="numero" class="form-control" value="{{ old('numero', auth()->user()->numero) }}">
                <input type="text" name="domicilio" class="form-control" value="{{ old('domicilio', auth()->user()->domicilio) }}">
                <input type="text" name="localidad" class="form-control" value="{{ old('localidad', auth()->user()->localidad) }}">
                <input type="text" name="municipio" class="form-control" value="{{ old('municipio', auth()->user()->municipio) }}">
                <input type="text" name="estado" class="form-control" value="{{ old('estado', auth()->user()->estado) }}">
                <input type="email" name="correo" class="form-control" value="{{ old('correo', auth()->user()->correo) }}">
                <input type="password" name="password_actual" class="form-control">
                <input type="password" name="password_nueva" class="form-control">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
</main>
@endsection