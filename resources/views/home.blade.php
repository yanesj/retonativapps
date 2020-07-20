
@extends('layouts.app')


@section('sidebar')
<div class="sidebar">
    <a class="active"  href="{{route('home')}}">Home</a>
    <a   href="{{route('estudiante')}}">Crear Estudiantes</a>
    <a   href="{{route('viewStudent')}}">Ver Estudiantes</a>
    <a   href="{{route('curso')}}">Crear Cursos</a>
    <a   href="{{route('viewCourses')}}">Ver Cursos</a>
    <a   href="{{route('asigCurso')}}">Asignar Cursos</a>
    <a class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    Salir
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>
</div>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">TOP DE LOS 3 CURSOS CON MÁS ESTUDIANTES EN LOS ÚLTIMOS 6 MESES</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                   <div class="row">
                    <div class="col-md-12">
                          <table class="table table-bordered">
                              <thead>
                                  
                                  <tr>
                                      <th>Cursos</th>
                                      <th>Cantidad de Estudiantes</th>
                                  </tr>

                              </thead>
                              <tbody>
                               @foreach ($cursos as $value)
                               <tr>
                                 <td>{{$value->materia}}</td>
                                 <td>{{$value->cant_estud}}</td>
                             </tr>
                             @endforeach
                         </tbody>
                       </table>
                     </div>
               </div>
           </div>
       </div>
   </div>
</div>
</div>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">CANTIDAD DE ESTUDIANTES REGISTRADOS MENSUALMENTE POR CURSO</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                  <div id="container" style="width: 75%;">
    <canvas id="canvas"></canvas>
  </div>

           </div>
       </div>
   </div>
</div>
</div>

<script type="text/javascript">
 var MONTHS = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    var color = Chart.helpers.color;
    var barChartData = {!! $cant_est !!};

    window.onload = function() {
      var ctx = document.getElementById('canvas').getContext('2d');
      window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'Gráfico de Barras'
          }
        }
      });

    };

    document.getElementById('randomizeData').addEventListener('click', function() {
      var zero = Math.random() < 0.2 ? true : false;
      barChartData.datasets.forEach(function(dataset) {
        dataset.data = dataset.data.map(function() {
          return zero ? 0.0 : randomScalingFactor();
        });

      });
      window.myBar.update();
    });

    var colorNames = Object.keys(window.chartColors);
    document.getElementById('addDataset').addEventListener('click', function() {
      var colorName = colorNames[barChartData.datasets.length % colorNames.length];
      var dsColor = window.chartColors[colorName];
      var newDataset = {
        label: 'Dataset ' + (barChartData.datasets.length + 1),
        backgroundColor: color(dsColor).alpha(0.5).rgbString(),
        borderColor: dsColor,
        borderWidth: 1,
        data: []
      };

      for (var index = 0; index < barChartData.labels.length; ++index) {
        newDataset.data.push(randomScalingFactor());
      }

      barChartData.datasets.push(newDataset);
      window.myBar.update();
    });

    document.getElementById('addData').addEventListener('click', function() {
      if (barChartData.datasets.length > 0) {
        var month = MONTHS[barChartData.labels.length % MONTHS.length];
        barChartData.labels.push(month);

        for (var index = 0; index < barChartData.datasets.length; ++index) {
          // window.myBar.addData(randomScalingFactor(), index);
          barChartData.datasets[index].data.push(randomScalingFactor());
        }

        window.myBar.update();
      }
    });

    document.getElementById('removeDataset').addEventListener('click', function() {
      barChartData.datasets.pop();
      window.myBar.update();
    });

    document.getElementById('removeData').addEventListener('click', function() {
      barChartData.labels.splice(-1, 1); // remove the label first

      barChartData.datasets.forEach(function(dataset) {
        dataset.data.pop();
      });

      window.myBar.update();
    });
 

</script>

@endsection

