@extends('layouts.admin')
@section('content')
<div class="list-group list-group-flush blue-grey">
      <a href="/privada" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-chart-pie mr-3"></i>Estadisticas</a>
      <a href="/bovinos/reg" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-user mr-3"></i>Especies</a>
      <a href="/unidad_de_produccion" class="list-group-item active waves-effect white-text">
        <i class="fas fa-map mr-3"></i>U. de Produccion</a>
      <a href="/pruebas/pruebas" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-table mr-3"></i>Pruebas</a>
      <a href="/perfil" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-user mr-3"></i>Perfil</a>
    </div>
  </div>
</header>
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
    <div class="container">
        <h2>Registrar Unidad de Producción</h2>
        <form action="{{ route('unidad_de_produccion.store') }}" method="POST" autocomplete="off">
            @csrf
            <input type="text" placeholder="Nombre" name="nombre" class="form-control" required>
            <input type="number" placeholder="Latitud" step="any" name="latitud" class="form-control" required>
            <input type="number" placeholder="Longitud" step="any" name="longitud" class="form-control" required>
            <input type="text" placeholder="UPP" name="upp" class="form-control" maxlength="12" required>
            <input type="hidden" name="id_propietario" value="{{ auth()->user()->id }}">
            <input type="text" placeholder="Domicilio" name="domicilio" id="domicilio" required>
            <input type="text" placeholder="Localidad" name="localidad" id="localidad" required>
            <input type="text" placeholder="Municipio" name="municipio" id="municipio" required>
            <input type="text" placeholder="Estado" name="estado" id="estado" required>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
    </div>
</main>
@endsection