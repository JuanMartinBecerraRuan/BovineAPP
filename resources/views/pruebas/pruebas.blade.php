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
            <h2>Pruebas</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th><b>Nombre</b></th>
                        <th><b>Tipo</b></th>
                        <th><b>Descripción</b></th>
                        <th><b>Inyección</b></th>
                        <th><b>Lectura</b></th>
                        <th><b>No. de Animales</b></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pruebas as $prueba)
                        @if ($prueba->id_propietario == auth()->user()->id)
                            <tr>
                                <td>{{ $prueba->nombre }}</td>
                                <td>{{ $prueba->tipo }}</td>
                                <td>{{ $prueba->descripcion }}</td>
                                <td>{{ $prueba->inyeccion }}</td>
                                <td>{{ $prueba->lectura }}</td>
                                <td>{{ $prueba->no_animales }}</td>
                                <td>
                                    <div class="text-center">
                                        @if ($prueba->lectura <= now())
                                            <a href="{{ route('pruebas.edit', $prueba) }}" class="btn btn-primary btn-sm">Editar</a>
                                        @else
                                            <a>No se puede editar</a>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <form action="{{ route('pruebas.destroy', $prueba) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <form action="{{ route('pruebas.registrar') }}">
            <button type="submit" class="button20">
                <i class="fas fa-plus"></i> <!-- Agrega el ícono de agregar -->
            </button>
        </form>
    </div>
</main>
@endsection