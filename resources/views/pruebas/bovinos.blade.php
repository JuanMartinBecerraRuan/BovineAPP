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
        <div class="container">
            <form action="{{route('agregar-detalles')}}" method="POST">
                @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <th>Seleccionar</th>
                            <th>No. Coqueta</th>
                            <th>Nombre</th>
                            <th>Edad</th>
                            <th>Raza</th>
                            <th>Sexo</th>
                            <th>Tipo</th>
                            <th>Fecha de Nacimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bovinos as $bovino)
                            @if ($bovino->id_propietario == auth()->user()->id)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="bovinos_seleccionados[]" value="{{ $bovino->id }}">
                                    </td>
                                    <td>{{ $bovino->no_coqueta }}</td>
                                    <td>{{ $bovino->nombre }}</td>
                                    <td>{{ $bovino->edad }}</td>
                                    <td>{{ $bovino->raza }}</td>
                                    <td>{{ $bovino->sexo }}</td>
                                    <td>{{ $bovino->tipo }}</td>
                                    <td>{{ $bovino->fecha_nacimiento }}</td>
                                </tr>
                            @endif
                        @endforeach 
                    </tbody>
                </table>
                <input type="hidden" name="id_prueba" value="{{ $id }}"><br>
                <button type="submit" class="btn btn-primary">Agregar Detalles</button>
            </form>
        </div>
    </div>
</main>
@endsection