@extends('layouts.admin')
@section('proyecto-selected', 'active')
@section('contenido')

    <h2>> Proyecto: <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}"><strong class="text-uppercase">{{$proyecto->nombre}}</strong></a></h2>    
    <div style="display:none;">
        <table id="footer_pdf">
            <tr>
                <td width="34%">
                    <p class="izq">DreamupCorp.com</p>
                </td>
                <td width="34%">
                    <p class="der">{{ Carbon\Carbon::now() }}</p>
                </td>
            </tr>
        </table>
        <h2 id="titulo_informe" style="color: #337ab7;">DIAGRAMA BURNDOWN DEL SPRINT</h2>
        <table border="0" cellspacing="0" cellpadding="0" id="detalle_pdf">
            <tr>
                <td width="40%">
                    <p><strong>Proyecto:</strong> {{ $proyecto->nombre }} </p><br>                                                
                    <p><strong>Fecha y Hora Actual:</strong> {{ Carbon\Carbon::now() }} </p>    
                </td>
                <td width="40%">
                    <p><strong>Sprint Actual:</strong> {{ $sprint->titulo}} </p><br> 
                    <p><strong>Estado Actual:</strong> {{ $sprint->porcentaje_sprint}}% </p>  
                </td>
            </tr>
        </table>
    </div>  
  <div class="panel panel-info main-panel">
    <div class="panel-heading">
        <h3 class="panel-title">Burndown del Sprint: <strong class="text-uppercase">{{$sprint->titulo}}</strong></h3>
        <div class="small-tools">
          <ul>                    
              <li>
                  <button id="download" class="btn btn-default btn-xs tooltips pull-right" data-placement="bottom" data-original-title="Imprimir"><i class="fa fa-file-pdf-o"></i></button>                       
              </li>
          </ul>
      </div>
    </div>
    @if($TRT==0)
      <div class="alert alert-warning mt">El Sprint aun no ha iniciado</div>
    @else
      <div class="row mt">
          <div class="col-md-7">              
            <div class="burndown-box center-block">
              <h5 id="labelY"><strong>Trabajo Restante</strong> <br/>(Horas trabajadas)</h5>
              <canvas id="burndown" height="300" width="450"></canvas>
              <h5 id="labelX" class="centered"><strong>Días</strong></h5>
            </div>                
          </div>          
          <div class="col-md-2">
              <h5 id="titulo_tabla1"><strong>Trabajo Restante Estimado</strong></h5>
              <table class="table table-bordered table-striped table-condensed cf" id="tabla1">
                  <thead> 
                      <tr>
                          <th width="4%">#</th>
                          <th width="48%">Tiempo restante</th>
                          <th width="48%">Día</th> 
                      </tr> 
                  </thead>
                  <tbody>
                  @foreach ($dias as $key => $dia) 
                      <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $curvaIdeal[$key] }}</td>
                          <td>{{ $dia }}</td>
                        </tr>                                   
                  @endforeach
                  </tbody>
              </table>  
          </div>          
          <div class="col-md-2">
              <h5 id="titulo_tabla2"><strong>Trabajo Restante</strong></h5>
              <table class="table table-bordered table-striped table-condensed cf" id="tabla2">
                  <thead> 
                      <tr>
                          <th width="4%">#</th>
                          <th width="48%">Tiempo restante</th>
                          <th width="48%">Día</th> 
                      </tr> 
                  </thead>
                  <tbody>
                  @foreach ($dias as $key => $dia) 
                      <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $curvaReal[$key] }}</td>
                          <td>{{ $dia }}</td>
                        </tr>                                   
                  @endforeach
                  </tbody>
              </table>  
          </div>  
      </div>
    @endif    
  </div>
  <a href="{{URL::previous()}}" class="btn btn-warning pull-left"><i class="fa fa-chevron-left"></i> Regresar</a>
@endsection
@section('scripts')  
  <script src="{{asset('js/Chart.bundle.js')}}"></script>
  <script src="{{asset('js/utils.js')}}"></script>
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