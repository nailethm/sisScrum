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
                <h2>PILAS DE SPRINTS</h2>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="20%"></td>
                        <td width="40%">
                            <p><strong>Proyecto:</strong> {{ $data2->nombre }} </p>
                            <p><strong>Fecha y Hora Actual:</strong> {{ Carbon\Carbon::now() }} </p>    
                        </td>
                        <td width="40%">
                            <p><strong>Scrum Master</strong> {{ $data3->where('rol','SM')->first()->usuario->name }} </p>
                            <p><strong>Dueño Producto:</strong> {{ $data3->where('rol','DP')->first()->usuario->name }} </p>
                        </td>
                    </tr>
                </table>
                                
            </div>
        </div>
        @foreach ($data1 as $key => $sprint)
            <table border="1" cellspacing="0" cellpadding="0" style="background-color: #d9edf7;">
                <thead>
                    <tr>
                        <th width="3%">#</th> 
                        <th width="55%">Sprint</th> 
                        <th width="10%">Estado</th>
                        <th width="15%">Fecha Inicio</th>
                        <th width="17%">Fecha Fin</th>                                                               
                    </tr>
                </thead>
                <tbody>                  
                    <tr>
                        <td>{{ $key+1 }}</td>   
                        <td>{{ $sprint->titulo }}</td>
                        <td>{{ $sprint->porcentaje_sprint }}% </td>                                             
                        <td>{{ $sprint->inicio_sprint }}</td>
                        <td>{{ $sprint->fin_sprint }}</td>                        
                    </tr>                                                        
                </tbody>            
            </table>            
            <table border="1" cellspacing="0" cellpadding="0">
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
                    @foreach ($sprint->historias()->where('estado','<>','0')->get() as $key => $historia) 
                        <tr>
                            <td><strong>H{{ $historia->idhistoria }}</strong></td>   
                            <td>Como <strong>{{ $historia->actor }}</strong> necesito <strong>{{ $historia->requerimiento }}</strong> así podré <strong>{{ $historia->funcionalidad }}</strong></td>                                             
                            <td>{{ $historia->prioridad }}</td>
                            <td>{{ $historia->porcentaje_historia }}% </td>
                            <td>{{ $historia->fecha_creacion }}</td>
                        </tr>                    
                    @endforeach
                </tbody>            
            </table>            
        @endforeach
    </body>
</html>