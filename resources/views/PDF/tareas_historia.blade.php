<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Pila del Producto</title>
        <style type="text/css">                        
          
            body{
                background: url("/img/default-img.jpg") no-repeat top left;
                font-family: sans-serif;
            }
            @page {
              margin: 30px 30px;
            }
            h2{
                margin-bottom: 0px;
                text-align: center;
                text-transform: uppercase;
                color: #337ab7;
            }
            p{
                text-transform: uppercase;
            }
            .subtitle{                
                text-align: center;
            }
            table{
                width: 100%;
            }
            table tr th,
            table tr td{
                padding: 5px;
            }
            table tr th{color: #337ab7;}
            footer .page:after {
                content: counter(page);
            }
            footer {
              position: fixed;
              left: 0px;
              bottom: -10px;
              right: 0px;
              height: 45px;
              border-bottom: 2px solid #ddd;
            }
            footer .page:after {
              content: counter(page);
            }
            footer table {
              width: 100%;
            }
            footer p {
              text-align: center;
            }
            footer .izq {
              text-align: left;
            }
            footer .der {
              text-align: right;
            }
        </style>
    </head>
    <body>
        <footer>
            <table>
                <tr>
                    <td width="34%">
                        <p class="izq">DreamupCorp.com</p>
                    </td>
                    <td width="32%">
                    <p class="page">
                        Página
                    </p>
                    </td>
                    <td width="34%">
                        <p class="der">{{ Carbon\Carbon::now() }}</p>
                    </td>
                </tr>
            </table>
        </footer>
        <div id="details" class="clearfix">
            <div>
                <h2>Tareas de la Historia</h2>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="16%"></td>
                        <td width="42%">
                            <p><strong>Proyecto:</strong> {{ $data2->nombre }} </p>
                            <p><strong>Scrum Master:</strong> {{ $data3->where('rol','SM')->first()->usuario->name }} </p>
                            <p><strong>Dueño Producto:</strong> {{ $data3->where('rol','DP')->first()->usuario->name }} </p>
                            <p><strong>Fecha y Hora Actual:</strong> {{ Carbon\Carbon::now() }} </p>    
                        </td>
                        <td width="42%">
                            <p><strong>Sprint Actual:</strong> {{ $data1->sprint->titulo }} </p>
                            <p><strong>Estado Actual:</strong> {{ $data1->sprint->porcentaje_sprint}}% </p>
                            <p><strong>Inicio Sprint:</strong> {{ $data1->sprint->inicio_sprint }} </p>
                            <p><strong>Fin Sprint:</strong> {{ $data1->sprint->fin_sprint }} </p>   
                        </td>
                    </tr>
                </table>
                                
            </div>
        </div>
        <table border="1" cellspacing="0" cellpadding="0" style="background: rgba(230,230,230,0.5);">
            <thead>
                <tr>
                    <th width="3%">#</th> 
                    <th width="55%">Historia</th> 
                    <th width="10%">Prioridad</th>
                    <th width="15%">Estado</th>
                    <th width="17%">Fecha cración</th>                                                               
                </tr>
            </thead>
            <tbody> 
                <tr>
                    <td><strong>H{{ $data1->idhistoria }}</strong></td>   
                    <td>Como <strong>{{ $data1->actor }}</strong> necesito <strong>{{ $data1->requerimiento }}</strong> así podré <strong>{{ $data1->funcionalidad }}</strong></td>                                             
                    <td>{{ $data1->prioridad }}</td>
                    <td>{{ $data1->nombre_estado_historia }}</td>
                    <td>{{ $data1->fecha_creacion }}</td>
                </tr>                    
            </tbody>            
        </table>
        <table border="1" cellspacing="0" cellpadding="0"> 
            <thead> 
                <tr> 
                    <th width="3%">#</th> 
                    <th width="40%">Tarea</th> 
                    <th width="17%">Asignado a</th> 
                    <th width="10%">Dificultad <span>1 a 5</span></th>
                    <th width="15%">Estado</th>
                </tr> 
            </thead> 
            <tbody> 
                @foreach ($data1->tareas()->where('estado','<>','0')->get() as $key => $tarea) 
                <tr>
                    <td>{{ $key+1 }}</td>   
                    <td>{{ $tarea->titulo }}</td>                                              
                    <td>{{ $tarea->usuario->name }}</td>
                    <td>{{ $tarea->dificultad }}</td>                        
                    <td>{{ $tarea->porcentaje_tarea }}%</td>                        
                </tr>                       
                @endforeach                     
            </tbody> 
        </table>
    </body>
</html>