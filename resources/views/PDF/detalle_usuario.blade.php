<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Usuarios</title>
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
                <h2>Datos de Usuario</h2>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="20%"></td>
                        <td width="40%">
                            <p><strong>Nombre:</strong> {{ $data1->name }}</p>
                            <p><strong>Fecha y Hora Actual:</strong> {{ Carbon\Carbon::now() }} </p>    
                        </td>
                        <td width="40%">
                            <p><strong>CI:</strong> {{ $data1->CI }}</p>
                            <p><strong>Cargo:</strong> {{ $data1->occupation }}</p>   
                        </td>
                    </tr>
                </table>                                                
            </div>
        </div>
        <h3>Proyectos Asignados:</h3>
        <table border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="49%">Proyecto</th>
                    <th width="10%">Estado</th>
                    <th width="12%">Inicio</th>
                    <th width="12%">Fin</th>
                    <th width="15%">Rol Asignado</th>                                       
                </tr>
            </thead>
            <tbody>
                @foreach ($data2 as $key => $proy)                
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $proy->proyecto->nombre }}</td>
                    <td>{{ $proy->proyecto->porcentaje_proyecto }}%</td>
                    <td>{{ $proy->proyecto->inicio_proyecto }}</td>
                    <td>{{ $proy->proyecto->fin_proyecto }}</td>
                    <td>{{ $proy->nombre_rol }}</td>                                                     
                </tr>
                @endforeach
            </tbody>            
        </table>        
    </body>
</html>