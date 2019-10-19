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
                <h2>Datos de Usuario</h2>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <p><strong>Nombre:</strong> Usuario</p>
                            <p><strong>Fecha y Hora:</strong> {{ Carbon\Carbon::now() }}</p>
                        </td>                        
                        <td>
                            <p><strong>Email:</strong> Usuario@gmail.com</p>
                            <p><strong>Cargo:</strong> Programador</p>
                        </td>                        
                    </tr>
                </table>                                                
            </div>
        </div>
        <h3>Tareas asignadas:</h3>
        <table border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="20%">Proyecto</th>
                    <th width="13%">Tarea</th>
                    <th width="20%">Avance Tarea</th>
                    <th width="13%">Horas Trabajadas (Hr)</th>                    
                </tr>
            </thead>
            <tbody>
                
                    <tr>
                        <td width="2%"></td>                        
                        <td width="20%">{{ $data->name }}</td>
                        <td width="13%">{{ $data->CI }}</a></td>
                        <td width="20%">80%</td>
                        <td width="20%">23</td>
                    </tr>                    
               
            </tbody>            
        </table>
    </body>
</html>