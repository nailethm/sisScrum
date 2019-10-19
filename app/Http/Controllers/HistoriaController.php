<?php

namespace sisScrum\Http\Controllers;

use Illuminate\Http\Request;

use sisScrum\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisScrum\Http\Requests\HistoriaFormRequest;

use sisScrum\Historia;
use sisScrum\Sprint;
use sisScrum\Proyecto;
use sisScrum\Backlog;
use sisScrum\Tarea;
use sisScrum\AvanceTarea;
use DB;
use Auth;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class HistoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create($idp)
    {
        return view("historias.create",["proyecto"=>Proyecto::findOrFail($idp)]);
    }
    public function store(HistoriaFormRequest $request, $idp)
    {
        $backlog=Backlog::where('idproyecto','=',$idp)->first();
        $idbacklog=$backlog->idbacklog;
        // Falta agragegar el id del usuario, e actualizar el idsprint
        $historia=new Historia;
        $historia->idbacklog=$idbacklog;
        $historia->idusuario=Auth::user()->id;
        $historia->actor=$request->get('actor');
        $historia->requerimiento=$request->get('requerimiento');
        $historia->funcionalidad=$request->get('funcionalidad');
        $historia->prioridad=$request->get('prioridad');
        $historia->notas=$request->get('notas');
        $historia->estado='1';
        $mifecha = Carbon::now();
        $historia->fecha_creacion= $mifecha->toDateString();
        $historia->save();
        return Redirect::to('proyectos/'.$idp.'/backlog');
    }
    public function show($idp, $idh)
    {
        $tareas = Tarea::where('idhistoria','=',$idh)
            ->where('estado','<>','0')
            ->orderBy('idtarea','desc')
            ->paginate(7);

        $totalTareas = Tarea::where('idhistoria','=',$idh)
            ->where('estado','<>','0')->count();
        $tareasCompletadas=Tarea::where('idhistoria','=',$idh)
            ->where('estado','=','3')->count();
        if ($totalTareas<>0 && $totalTareas==$tareasCompletadas) {
            $historia=Historia::findOrFail($idh);
            $historia->estado='3';
            $historia->update();
        }
        $proyecto = Proyecto::findOrFail($idp);
        $historia=Historia::findOrFail($idh);        
        
        return view("historias.show")->with(compact('tareas', 'proyecto', 'historia'));
    }
    public function edit($idp, $idh)
    {
        $proyecto=Proyecto::where('idproyecto','=',$idp)->first();

        return view("historias.edit",["proyecto"=>$proyecto,"historia"=>Historia::findOrFail($idh)]);
    }
    public function update(HistoriaFormRequest $request,$idp,$idh)
    {
        $historia=Historia::findOrFail($idh);
        $historia->actor=$request->get('actor');
        $historia->requerimiento=$request->get('requerimiento');
        $historia->funcionalidad=$request->get('funcionalidad');
        $historia->prioridad=$request->get('prioridad');
        $historia->notas=$request->get('notas');
        $historia->update();
        return Redirect::to('proyectos/'.$idp.'/backlog');
    }
    public function destroy($idp,$idh)
    {
        $historia=Historia::findOrFail($idh);
        // $historia->estado='0';
        $historia->delete();
        return Redirect::to('proyectos/'.$idp.'/backlog');
    }
}
