@extends('layouts.admin')
@section('content')
<div class="list-group list-group-flush blue-grey">
      <a href="/privada" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-chart-pie mr-3"></i>Estadisticas</a>
      <a href="/bovinos/reg" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-user mr-3"></i>Especies</a>
      <a href="/unidad_de_produccion" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-map mr-3"></i>U. de Produccion</a>
      <a href="/pruebas/pruebas" class="list-group-item active waves-effect white-text">
        <i class="fas fa-table mr-3"></i>Pruebas</a>
      <a href="/perfil" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-user mr-3"></i>Perfil</a>
    </div>
  </div>
</header>
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <h2>Registrar una nueva prueba</h2>
        <form action="{{ route('pruebas.store') }}" method="POST" autocomplete="off">
            @csrf
            <input type="text" placeholder="Nombre" name="nombre" required>
            <input type="text" placeholder="Tipo" name="tipo" required>
            <label>Fecha de prueba (inicio):</label>
            <input type="date" name="inyeccion" required>
            <label>Fecha de lectura (final):</label>
            <input type="date" name="lectura" required>
            <input type="hidden" name="no_animales" value=0 required>
            <input type="hidden" name="id_propietario" value="{{ auth()->user()->id }}"><br>
            <label for="descripcion">Descripción:</label><br>
            <textarea name="descripcion" required rows="7" cols="156"></textarea><br>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</main>
@endsection