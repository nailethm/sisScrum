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
                text-transform: uppercase;
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
                <h2>LISTADO DE USUARIOS</h2>
                <div class="subtitle">DEL AÑO <strong> {{ $data2 }} </strong></div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="16%"></td>
                        <td>
                                                                
                        </td>
                        <td>                            
                            <p><strong>Fecha Actual:</strong> {{ Carbon\Carbon::now() }} </p>       
                        </td>
                    </tr>
                </table>
                <hr>                
            </div>
        </div>        
        <h3>Personal Activo:</h3>
        <table border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="10%">Fecha</th>
                    <th width="28%">Nombre</th>
                    <th width="10%">CI</th>
                    <th width="25%">Email</th>
                    <th width="10%">Celular</th>
                    <th width="15%">Cargo</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach ($data1 as $key => $usuario)                     
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $usuario->updated_at->format('m/d/Y') }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->CI }}{{ $usuario->issued }}</a></td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->phone }}</td>
                        <td>{{ $usuario->occupation }}</a></td>
                    </tr>                                        
                @endforeach
            </tbody>            
        </table>
    </body>
</html>