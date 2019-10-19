<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Usuarios</title>
        <style type="text/css">
            h2{
                margin-bottom: 0px;
                text-align: center;
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
        </style>
    </head>
    <body>
        <div id="details" class="clearfix">
            <div>
                <h2>LISTADO DE USUARIOS</h2>
                <div class="subtitle">del mes </div>
                <p><strong>Fecha y Hora:</strong> {{ Carbon\Carbon::now() }} </p>                
            </div>
        </div>
        <table border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="15%">Fecha Registro</th>
                    <th width="20%">Nombre</th>
                    <th width="13%">CI</th>
                    <th width="20%">Email</th>
                    <th width="10%">Celular</th>
                    <th width="20%">Cargo</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $usuario) 
                    <tr>
                        <td width="2%">{{ $key+1 }}</td>
                        <td width="15%">{{ $usuario->created_at }}</td>
                        <td width="20%">{{ $usuario->name }}</td>
                        <td width="13%">{{ $usuario->CI }}</a></td>
                        <td width="20%">{{ $usuario->email }}</td>
                        <td width="10%">{{ $usuario->phone }}</td>
                        <td width="20%">{{ $usuario->occupation }}</a></td>
                    </tr>                    
                @endforeach
            </tbody>            
        </table>
    </body>
</html>