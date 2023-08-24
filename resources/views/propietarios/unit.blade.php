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
          <h2>Unidades de Producción</h2>
          <table class="table">
              <thead>
                  <tr>
                      <th style="width: 25%;"><b>Nombre</b></th>
                      <th style="width: 65%;"><b>Ubicación</b></th>
                      <th style="width: 5%;"></th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($unidades as $unidad)
                    @if ($unidad->id_propietario == auth()->user()->id)
                      <tr>
                          <td>
                            <label><span style="font-weight: bold;">Nombre:</span> {{ $unidad->nombre }}</label><br>
                            <label><span style="font-weight: bold;">UPP:</span> {{ $unidad->upp }}</label><br>
                            <label><span style="font-weight: bold;">Localidad:</span> {{ $unidad->localidad }}</label><br>
                            <label><span style="font-weight: bold;">Municipio:</span> {{ $unidad->municipio }}</label><br>
                            <label><span style="font-weight: bold;">Estado:</span> {{ $unidad->estado }}</label>
                          </td>
                          <td>
                            <div id="map-{{ $unidad->id }}" class="z-depth-1-half" style="width: 700px; height: 150px;"></div>
                            <script>
                                function initializeMap{{ $unidad->id }}() {
                                    var location = { lat: {{ $unidad->latitud }}, lng: {{ $unidad->longitud }} };
                                    var map = new google.maps.Map(document.getElementById("map-{{ $unidad->id }}"), {
                                        center: location,
                                        zoom: 12
                                    });
                                    var marker = new google.maps.Marker({
                                        position: location,
                                        map: map
                                    });
                                }
                                function loadGoogleMaps{{ $unidad->id }}() {
                                    var script = document.createElement('script');
                                    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBfmJOzz-TAy6oejE7IOtnu-9gT154wG8A&libraries=places&callback=initializeMap{{ $unidad->id }}';
                                    script.async = true;
                                    script.defer = true;
                                    document.body.appendChild(script);
                                }
                                loadGoogleMaps{{ $unidad->id }}();
                            </script>
                          </td>
                          <td>
                            <div class="text-center">
                                <a href="" class="btn btn-primary btn-sm">Editar</a>
                            </div>
                          </td>
                      </tr>
                    @endif
                  @endforeach
              </tbody>
          </table>
      </div>
      <form action="{{ route('propietario.createunit') }}">
          <button type="submit" class="button20">
              <i class="fas fa-plus"></i> <!-- Agrega el ícono de agregar -->
          </button>
      </form>
    </div>
</main>
@endsection