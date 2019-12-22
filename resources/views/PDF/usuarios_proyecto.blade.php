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
                <h2>Participantes del Proyecto</h2>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="16%"></td>
                        <td>
                            <p><strong>Proyecto:</strong> {{ $data1->nombre }} </p>
                            <p><strong>Descripción:</strong> {{ $data1->descripcion }} </p>        
                        </td>
                        <td>
                            <p><strong>Inicio:</strong> {{ $data1->inicio_proyecto }} </p>
                            <p><strong>Fecha:</strong> {{ $data1->fin_proyecto }} </p>       
                        </td>
                    </tr>
                </table>
                <hr>                
            </div>
        </div>        
        <h3>Participantes:</h3>
        <table border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="15%">Rol Asignado</th>
                    <th>Nombre</th>
                    <th width="30%">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data2 as $key => $usuario)                
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $usuario->nombre_rol }}</td>
                    <td>{{ $usuario->usuario->name }}</td>
                    <td>{{ $usuario->usuario->email }}</td>
                </tr>
                @endforeach
            </tbody>            
        </table>
    </body>
</html>