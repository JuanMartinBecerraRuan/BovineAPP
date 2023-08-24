@extends('layouts.admin')
@section('content')
<div class="list-group list-group-flush blue-grey">
      <a href="/privada" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-chart-pie mr-3"></i>Estadisticas</a>
      <a href="/bovinos/reg" class="list-group-item active waves-effect white-text">
        <i class="fas fa-user mr-3"></i>Especies</a>
      <a href="/unidad_de_produccion" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
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
            <h2>Bovinos</h2>
            <div class="row">
                @foreach($bovinos as $bovino)
                  @if ($bovino->id_propietario == auth()->user()->id)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $bovino->foto) }}" width="100" height="300" class="card-img-top">
                            <div class="card-body">
                              <h5 class="card-title">{{ $bovino->nombre }}</h5>
                              <p class="card-text">
                                  <strong>Edad:</strong> {{ $bovino->edad }} meses<br>
                                  <strong>Sexo:</strong> {{ $bovino->sexo }}<br>
                                  <strong>Tipo:</strong> {{ $bovino->tipo }}
                              </p>
                              <div class="d-flex justify-content-between"> <!-- Utiliza d-flex y justify-content-between para alinear los botones -->
                                <a href="{{route('bovinos.edit', $bovino->id)}}" class="btn btn-primary">Detalles</a>
                                <form action="{{ route('bovinos.destroy', $bovino->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                              </div>
                            </div>
                        </div>
                    </div>
                  @endif
                @endforeach
            </div>
        </div>
        <form action="{{ route('bovinos.create') }}">
            <button type="submit" class="button20">
                <i class="fas fa-plus"></i> <!-- Agrega el ícono de agregar -->
            </button>
        </form>
    </div>
</main>
@endsection