<div class="internal-nav">
    <ul class="options-nav">
        <li class="@yield('op1-selected')"><a href="{{URL::action('ProyectoController@show',$proyecto->idproyecto)}}"><span>Proyecto</span> </a> </li>
        <li class="@yield('op2-selected')"><a href="{{URL::action('BacklogController@index',$proyecto->idproyecto)}}"><span>Backlog</span> </a> </li>
        <li class="@yield('op3-selected')"><a href="{{URL::action('SprintController@index',$proyecto->idproyecto)}}"><span>Sprints</span> </a> </li>
        <li class="@yield('op4-selected')"><a href="#"><span>Entregables</span> </a> </li>
        <li class="@yield('op5-selected')"><a href="{{URL::action('AsignadoController@index',$proyecto->idproyecto)}}"><span>Equipo</span> </a> </li>
        <li class="@yield('op6-selected')"><a href="#"><span>Reuniones</span> </a> </li>
    </ul>                            
</div>