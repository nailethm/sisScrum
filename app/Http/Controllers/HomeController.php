<?php

namespace sisScrum\Http\Controllers;

use sisScrum\Http\Requests;
use Illuminate\Http\Request;
use sisScrum\User;
use sisScrum\Asignado;
use sisScrum\Tarea;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $miId = Auth::user()->id ;
        $misProyectos=Asignado::where('idusuario','=',$miId)->with('proyecto')->paginate(10);        
        $misTareasProgreso = Tarea::where('idusuario','=',$miId)->where('estado','=','2')->paginate(10);                        

        return view('home')->with(compact('misProyectos', 'misTareasProgreso'));
    }
    public function mistareas()
    {
        $miId = Auth::user()->id ;                
        $misTareasTerminadas = Tarea::where('idusuario','=',$miId)->where('estado','=','3')->paginate(10);
        $misTareasProgreso = Tarea::where('idusuario','=',$miId)->where('estado','=','2')->paginate(10);

        return view('tareas')->with(compact('misTareasTerminadas', 'misTareasProgreso'));
    }
}
