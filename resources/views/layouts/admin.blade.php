<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Scrum Panel Control">
    <meta name="keyword" content="Scrum, Bootstrap, Admin, Template, Theme, Responsive">

    <title>Sistema de Gestión Scrum</title>

    <link rel="Shortcut Icon" href="{{asset('favicon.ico')}}">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap-select.min.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('css/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/zabuto_calendar.css')}}">
    <!-- JQuery UI core CSS-->
    <link href="{{asset('css/jquery-ui.min.css')}}" rel="stylesheet"> 
    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/style-responsive.css')}}" rel="stylesheet">
    
    <link href="{{asset('css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

    <script src="{{asset('js/chart-master/Chart.js')}}"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!--Main Container-->
    <div id="container" >

        <!--Header section-->
        <header class="header">
            <div class="main-navbar">
                <nav class="navbar navbar-default">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">                            
                            <a class="logo" href="#"><img src="{{asset('img/logo.png')}}" /></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            @if (auth()->check())
                            <ul class="nav navbar-right">
                                <li><a href="{{URL::action('UsuarioController@show', Auth::user()->id)}}"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a></li>
                                <li><a class="salir" href="{{url('/logout')}}"><i class="fa fa-power-off"></i></a></li>
                            </ul>
                            @endif
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
            <div class="subnavbar">
                <div class="subnavbar-inner">
                    <div class="container">
                        <ul class="mainnav">
                            <li class="@yield('home-selected')"><a href="{{url('home')}}"><i class="fa fa-dashboard"></i><span>Inicio</span> </a> </li>
                            <li class="@yield('proyecto-selected')"><a href="{{url('proyectos')}}"><i class="fa fa-folder-open"></i><span>Proyectos</span> </a> </li>
                            <li class="@yield('tarea-selected')"><a href="{{url('mistareas')}}"><i class="fa fa-list-alt"></i><span>Mis tareas</span> </a> </li>                            
                        </ul>
                        @if(auth()->check() && Auth::user()->isAdmin())
                            <div class="admin-tools">
                                <!--<h4>Herramientas de Administración</h4>-->
                                <ul class="admin-nav">
                                    <li class="a-proyecto @yield('reportes-selected')"><a href="{{url('seguridad/reportes')}}"><i class="fa fa-folder"></i><span>Administrar Reportes</span> </a> </li>
                                    <li class="a-usuario @yield('usuarios-selected')"><a href="{{url('seguridad/usuario')}}"><i class="fa fa-group"></i><span>Administrar Usuarios</span> </a> </li>
                                    <!-- <li class="a-sistema"><a href="#"><i class="fa fa-gears"></i><span>Administrar Sistema</span> </a> </li> -->
                                </ul>
                            </div>
                        @endif
                        <div class="current-date">
                            <h6>Fecha y Hora Actual</h6>
                            <strong> {{ Carbon\Carbon::now() }} </strong>
                        </div>                                                                    
                    </div>
                    <!-- /container -->
                </div>
                <!-- /subnavbar-inner -->
            </div>
        </header>
        <!--header end-->

        <!--Main container start-->
        <section class="wrapper">
            <div class="container">
                <!-- Main Container start -->
                <!-- <div class="row">
                    <div class="col-lg-9"> -->
                        <div class="main-content"> 
                        <!-- Contenido -->
                        @yield('contenido')
                        <!-- Fin Contenido -->
                        </div>
                    </div>
                    <!--<div class="col-lg-3 sidebar-content">
                        <div class="panel panel-danger">
                            <div class="panel-heading">Eventos</div>
                            <div class="panel-body">
                                <div id="my-calendar"></div>    
                            </div>
                        </div>
                         <div class="panel panel-success">
                            <div class="panel-heading">Equipo del Proyecto</div>
                            <div class="panel-body">
                                <ul class="media-list">
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="img/profiles/fr-06.jpg" alt="..." width="50">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="media-heading tooltips" data-original-title="Perfil" data-placement="bottom">
                                                <span class="name-user">Laura Solano</span>
                                                <span class="title-user">UI Developer</span>
                                            </a>
                                        </div>
                                        <div class="task-id">
                                            <a href="#">
                                                <h4>Tarea asignada:</h4>
                                                <p class="double-title">T<span>25</span></p>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="img/profiles/fr-06.jpg" alt="..." width="50">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="media-heading">
                                                <span class="name-user">Laura Solano</span>
                                                <span class="title-user">UI Developer</span>
                                            </a>
                                        </div>
                                        <div class="task-id">
                                            <a href="#"><h4>Tarea asignada:</h4>
                                                <p class="double-title">T<span>25</span></p></a>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="img/profiles/fr-06.jpg" alt="..." width="50">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <a href="#" class="media-heading">
                                                <span class="name-user">Laura Solano</span>
                                                <span class="title-user">UI Developer</span>
                                            </a>
                                        </div>
                                        <div class="task-id">
                                            <a href="#"><h4>Tarea asignada:</h4>
                                            <p class="double-title">T<span>25</span></p></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div> -->
                        <!-- <div class="panel panel-warning">
                            <div class="panel-heading">Actividades Recientes</div>
                            <div class="panel-body">
                                <ul class="media-list"> 
                                    <li class="media"> 
                                        <div class="media-left"> 
                                            <a href="#"> <img alt="25x25" class="media-object" src="img/default-img.jpg" width="30" height="30"> </a> 
                                        </div> 
                                        <div class="media-body">                                             
                                            <p><span class="datetime">21-02-2017 a 15:00</span><a href="#">James Brown</a> Cras sit amet nibh libero, in gravida nulla.</p> 
                                        </div> 
                                    </li>
                                    <li class="media"> 
                                        <div class="media-left"> 
                                            <a href="#"> <img alt="25x25" class="media-object" src="img/default-img.jpg" width="30" height="30"> </a> 
                                        </div> 
                                        <div class="media-body">                                             
                                            <p><span class="datetime">21-02-2017 a 15:00</span><a href="#">James Brown</a> Cras sit amet nibh libero, in gravida nulla.</p> 
                                        </div> 
                                    </li>                                
                                </ul>
                            </div>
                        </div> 
                    </div> 
                </div> -->
               
                
                    <!-- Main Container End -->
            </div>
        </section>

        <!--footer start-->
        <footer class="site-footer">
            <div class="text-center">
                &copy; 2019 DREAMUP Corporation
            </div>
        </footer>
        <!--footer end-->
    </div>

	<!-- js placed at the end of the document so the pages load faster -->
    <script src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jspdf.debug.js')}}"></script>
    <script src="{{asset('js/jspdf.plugin.autotable.js')}}"></script>
    <script src="{{asset('js/html2canvas.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>

	<!--common script for all pages-->
	<script src="{{asset('js/zabuto_calendar.js')}}"></script>
	<script src="{{asset('js/common-scripts.js')}}"></script>

    <!--Jquery UI-->
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <!--<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.es.min.js')}}"></script>-->

    <!--custom switch-->
    <script src="{{asset('js/bootstrap-switch.js')}}"></script>

    <!--custom tagsinput-->
    <script src="{{asset('js/jquery.tagsinput.js')}}"></script>

    <!--custom checkbox & radio-->
    <script type="text/javascript" src="{{asset('js/bootstrap-inputmask/bootstrap-inputmask.min.js')}}"></script>

    <script src="{{asset('js/general.js')}}"></script>
    <script src="{{asset('js/form-component.js')}}"></script>
    @yield('scripts')

</body>
</html>