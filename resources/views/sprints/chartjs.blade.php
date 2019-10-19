@extends('layouts.admin')
@section('proyecto-selected', 'active')
@section('contenido')

    <h2>> Proyecto: <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}"><strong class="text-uppercase">{{$proyecto->nombre}}</strong></a></h2>    
  
  <div class="panel panel-info main-panel">
    <div class="panel-heading">
        <h3 class="panel-title">Burndown del Sprint</h3>
    </div>
    @if($TRT==0)
      <div class="alert alert-warning mt">El Sprint aun no ha iniciado</div>
    @else
      <div class="burndown-box center-block">
        <h5>Trabajo Restante <br/>(Puntos de Historia)</h5>
        <canvas id="burndown" height="300" width="450"></canvas>
        <h5 class="centered">Días</h5>
      </div>
    @endif
  </div>
  <a href="{{URL::previous()}}" class="btn btn-warning pull-left"><i class="fa fa-chevron-left"></i> Regresar</a>
@endsection
@section('scripts')
  <script src="http://www.chartjs.org/dist/2.7.3/Chart.bundle.js"></script>
  <script src="http://www.chartjs.org/samples/latest/utils.js"></script>
  <script>
    var chartdata = {
      type: 'line',
      data: {
        labels: <?php echo json_encode($dias); ?>,
        datasets: [
          {
              label: 'Trabajo Restante Estimado',
              backgroundColor: "rgba(0, 0, 0, 0)",
              borderColor : "rgba(0,0,0,0.4)",              
              data : <?php echo json_encode($curvaIdeal); ?>
          },
          {
              label: 'Trabajo Restante',
              backgroundColor: "rgba(0, 0, 0, 0)",
              borderColor : "rgba(1,125,194,0.8)",
              data : <?php echo json_encode($curvaReal); ?>
          }
        ]
      }
      }
    var ctx = document.getElementById('burndown').getContext('2d');
    new Chart(ctx, chartdata);
  </script>
@endsection    