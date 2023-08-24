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
            <h2>Editar una prueba</h2>
            <form action="{{ route('pruebas.update', $prueba->id) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <input type="text" placeholder="Nombre" name="nombre" value="{{ $prueba->nombre }}" required>
                <input type="text" placeholder="Tipo" name="tipo" value="{{ $prueba->tipo }}" required>
                <label>Fecha de prueba (inicio):</label>
                <input type="date" name="inyeccion" value="{{ $prueba->inyeccion }}" required>
                <label>Fecha de lectura (final):</label>
                <input type="date" name="lectura" value="{{ $prueba->lectura }}" required>
                <input type="hidden" name="no_animales" value="{{ $prueba->no_animales }}" required>
                <input type="hidden" name="id_propietario" value="{{ auth()->user()->id }}"><br>
                <label for="descripcion">Descripción:</label><br>
                <textarea name="descripcion" required rows="7" cols="136">{{ $prueba->descripcion }}</textarea><br>
                <table class="table">
                    <tbody>
                        @foreach ($bovinos as $bovino)
                            <tr>
                                <td>{{ $bovino->no_coqueta }}</td>
                                <td>{{ $bovino->nombre }}</td>
                                <td>{{ $bovino->edad }}</td>
                                <td>{{ $bovino->raza }}</td>
                                <td>{{ $bovino->sexo }}</td>
                                <td>{{ $bovino->tipo }}</td>
                                <td>{{ $bovino->fecha_nacimiento }}</td>
                                <td>
                                    <select name="resultado[{{ $bovino->id }}]">
                                        <option value="Negativo">Negativo</option>
                                        <option value="Sospechoso">Sospechoso</option>
                                        <option value="Reactor">Reactor</option>
                                        <option value="Exento">Exento</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
</main>
@endsection