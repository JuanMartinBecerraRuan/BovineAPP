@extends('layouts.admin')
@section('content')
<div class="list-group list-group-flush blue-grey">
      <a href="/privada" class="list-group-item active waves-effect white-text">
        <i class="fas fa-chart-pie mr-3"></i>Estadisticas</a>
      <a href="/bovinos/reg" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
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
<main class="pt-5 mx-lg-5 d-flex align-items-center justify-content-center">
  <div class="container-fluid mt-5">
    <div class="container" style="width: 30%; float: left;">
      <h2>Razas</h2>
      <div style="width: 80%; margin: 0 auto;">
          <canvas id="razasChart"></canvas>
      </div>
      <script>
          var razasCount = @json($razasCount);
          var labels = Object.keys(razasCount);
          var data = Object.values(razasCount);
          var ctx = document.getElementById("razasChart").getContext("2d");
          var pieChart = new Chart(ctx, {
              type: "pie",
              data: {
                  labels: labels,
                  datasets: [{
                      data: data,
                      backgroundColor: [
                        "#1F77B4",
                        "#AEC7E8",
                        "#FF7F0E",
                        "#FFBB78",
                        "#2CA02C",
                        "#98DF8A",
                        "#D62728",
                        "#FF9896",
                        "#9467BD",
                        "#C5B0D5",
                        "#8C564B",
                        "#C49C94",
                        "#E377C2",
                        "#F7B6D2",
                        "#7F7F7F",
                        "#C7C7C7",
                        "#BCBD22",
                        "#DBDB8D"
                      ],
                  }],
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
              },
          });
      </script>
    </div>
    <div class="container" style="width: 20%; float: right;">
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th>CRUZAS DE GANADO</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($machos as $macho)
                  @foreach ($hembras as $hembra)
                      <tr>
                          <td>{{ $macho->raza }} &mdash; {{ $hembra->raza }}</td>
                      </tr>
                  @endforeach
              @endforeach
          </tbody>
      </table>
    </div>
    <div class="container" style="width: 20%; float: right;">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title">Total:</h5>
              <p class="card-text" style="font-size: 12rem;">{{ $totalBovinos }}</p>
          </div>
      </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Imágenes</h5>
            <div class="d-flex flex-wrap">
                @foreach ($imagenesAleatorias as $imagen)
                    <div class="mx-2 my-2">
                        <img src="{{ asset('storage/' . $imagen->foto) }}" alt="Imagen de Bovino" class="square-image">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="d-flex mt-4">
        <div class="card" style="flex: 1;">
            <div class="card-body">
                <h5 class="card-title">Edad de Bovinos</h5>
                <canvas id="edadChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
        <div class="card" style="flex: 1;">
            <div class="card-body">
              <IFRAME ID='frmIE' width='400px' height='400px' scrolling='no' frameborder='0' src='https://www.inegi.org.mx/app/widgetgenerico//widget.html?IdSeries=,6207077727|0700-0700|6,6207077730|0700-0700|6,6207077735|0700-0700|6,6207077736|0700-0700|6,6207129571|0700-0700|6,6207129576|0700-0700|6,6207129577|0700-0700|6,6207129586|0700-0700|6,6207129593|0700-0700|6,6207129601|0700-0700|6,6207129611|0700-0700|6,6207129613|0700-0700|6,6207129621|0700-0700|6'></IFRAME>
            </div>
        </div>
    </div>
    <script>
        var bovinosPorEdad = @json($bovinosPorEdad);
        var ctx = document.getElementById("edadChart").getContext("2d");
        var lineChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: Object.keys(bovinosPorEdad),
                datasets: [{
                    label: "Número de Bovinos",
                    data: Object.values(bovinosPorEdad),
                    fill: false,
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "Edad (meses)"
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "Número de Bovinos"
                        }
                    }
                }
            }
        });
    </script>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Tipos de Bovinos</h5>
            <canvas id="tipoBovinoChart" style="max-height: 300px;"></canvas>
        </div>
    </div> 
    <script>
        var tiposDeBovinos = @json($tiposDeBovinos);

        var ctx = document.getElementById("tipoBovinoChart").getContext("2d");
        var barChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: Object.keys(tiposDeBovinos),
                datasets: [{
                    label: "Número de Bovinos",
                    data: Object.values(tiposDeBovinos),
                    backgroundColor: "rgba(75, 192, 192, 0.6)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "Tipo de Bovino"
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: "Número de Bovinos"
                        }
                    }
                }
            }
        });
    </script>
  </div>
</main>
@endsection