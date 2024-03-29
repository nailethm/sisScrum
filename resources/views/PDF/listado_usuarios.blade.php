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
              height: 40px;
              border-bottom: 2px solid #ddd;
            }
            footer .page:after {
              content: counter(page);
            }
            footer table {
              width: 100%;
            }
            footer p {
              text-align: right;
            }
            footer .izq {
              text-align: left;
            }
        </style>
    </head>
    <body>
        <footer>
            <table>
                <tr>
                    <td>
                        <p class="izq">DreamupCorp.com</p>
                    </td>
                    <td>
                    <p class="page">
                        Página
                    </p>
                    </td>
                </tr>
            </table>
        </footer>
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
                @foreach ($data1 as $key => $usuario) 
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