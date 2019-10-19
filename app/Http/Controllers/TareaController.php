<?php

namespace sisScrum\Http\Controllers;

use Illuminate\Http\Request;

use sisScrum\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisScrum\Http\Requests\TareaFormRequest;
use sisScrum\Tarea;
use sisScrum\Historia;
use sisScrum\Sprint;
use sisScrum\Proyecto;
use sisScrum\Backlog;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;


class TareaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($idp,$idh)
    {
        $historia=Historia::findOrFail($idh);
        $proyecto=Proyecto::findOrFail($idp);
        $programadores=$proyecto->asignados()->where('rol','=','Eq')->get();
        
        return view('tareas.create')->with(compact('historia','proyecto','programadores'));
    }

    public function store(TareaFormRequest $request, $idp, $idh)
    {
        // Falta agragegar el id del usuario, e actualizar el idsprint
        $tarea=new Tarea;
        $tarea->idhistoria=$idh;
        $tarea->idusuario=$request->get('idusuario'); //Quitar input, colocar select con usuarios
        $tarea->titulo=$request->get('titulo');
        $tarea->descripcion=$request->get('descripcion');
        $tarea->dificultad=$request->get('dificultad');
        $tarea->testimado=$request->get('testimado');
        $tarea->estado='1';
        $tarea->save();
        return Redirect::to('proyectos/'.$idp.'/historias/'.$idh.'/show');
    }

    public function edit($idp, $idh,$idt)
    {
        return view("tareas.edit",["proyecto"=>Proyecto::findOrFail($idp),"historia"=>Historia::findOrFail($idh),"tarea"=>Tarea::findOrFail($idt)]);
    }
    public function update(TareaFormRequest $request,$idp,$idh,$idt)
    {
        $tarea=Tarea::findOrFail($idt);        
        $tarea->idusuario=$request->get('idusuario'); //Quitar input, colocar select con usuarios
        $tarea->titulo=$request->get('titulo');
        $tarea->descripcion=$request->get('descripcion');
        $tarea->dificultad=$request->get('dificultad');
        $tarea->testimado=$request->get('testimado');        
        $tarea->update();
        return Redirect::to('proyectos/'.$idp.'/historias/'.$idh.'/show');
    }
    public function destroy($idp,$idh,$idt)
    {
        $tarea=Tarea::findOrFail($idt);
        $tarea->estado='0';
        $tarea->update();
        return back();
    }
}
