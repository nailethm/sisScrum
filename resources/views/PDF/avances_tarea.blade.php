<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Avances de la Tarea</title>
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
                <h2>Avances de la Tarea</h2>
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
                            <p><strong>Sprint Actual:</strong> {{ $data1->historia->sprint->titulo }} </p>
                            <p><strong>Estado Actual:</strong> {{ $data1->historia->sprint->porcentaje_sprint}}% </p>
                            <p><strong>Inicio Sprint:</strong> {{ $data1->historia->sprint->inicio_sprint }} </p>
                            <p><strong>Fin Sprint:</strong> {{ $data1->historia->sprint->fin_sprint }} </p>   
                        </td>
                    </tr>
                </table>
                                
            </div>
        </div>
        <table border="1" cellspacing="0" cellpadding="0" style="background: rgba(255,215,119,0.1);">
            <thead>
                <tr>
                    <th width="3%">#</th> 
                    <th>Tarea</th>
                    <th>Descripción</th>                      
                    <th width="10%">Dificultad <span>1 a 5</span></th>
                    <th width="9%">Tiempo estimado</th>
                    <th width="7%">Estado</th>
                    <th width="15%">Asignado a</th>                                                               
                </tr>
            </thead>
            <tbody> 
                <tr>
                    <td>{{ $data1->idtarea }}</td>
                    <td>{{ $data1->titulo }}</td>
                    <td>{{ $data1->descripcion }}</td>
                    <td>{{ $data1->dificultad }}</td>
                    <td>{{ $data1->testimado }}</td>
                    <td>{{ $data1->porcentaje_tarea }}% </td>
                    <td>{{ $data1->usuario->name }}</td>
                </tr>                    
            </tbody>            
        </table>
        <table border="1" cellspacing="0" cellpadding="0"> 
            <thead> 
                <tr> 
                    <th width="3%">#</th> 
                    <th width="10%">Fecha</th> 
                    <th>Comentario</th>                         
                    <th width="14%">Hr Trabajadas <span>En Hr</span></th>
                </tr> 
            </thead> 
            <tbody> 
                @foreach ($data1->avances()->get() as $key => $avance) 
                <tr>
                    <td>{{ $key+1 }}</td>   
                    <td>{{ $avance->fecha }}</td>                                              
                    <td>{{ $avance->comentario }}</td>
                    <td>{{ $avance->htrabajada }}</td>                                                                    
                </tr>                       
                @endforeach                     
            </tbody> 
        </table>
    </body>
</html>