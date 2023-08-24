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
            <div class="card">
                <div class="card-header">
                    Detalles del Propietario
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ auth()->user()->nombre }}</p>
                    <p><strong>Apellido Paterno:</strong> {{ auth()->user()->apellido_paterno }}</p>
                    <p><strong>Apellido Materno:</strong> {{ auth()->user()->apellido_materno }}</p>
                    <p><strong>Número:</strong> {{ auth()->user()->numero }}</p>
                    <p><strong>Domicilio:</strong> {{ auth()->user()->domicilio }}</p>
                    <p><strong>Localidad:</strong> {{ auth()->user()->localidad }}</p>
                    <p><strong>Municipio:</strong> {{ auth()->user()->municipio }}</p>
                    <p><strong>Estado:</strong> {{ auth()->user()->estado }}</p>
                    <p><strong>Correo:</strong> {{ auth()->user()->correo }}</p>
                    <a href="{{ route('propietarios.edit') }}" class="btn btn-primary">Editar Propietario</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection