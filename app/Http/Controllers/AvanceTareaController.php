<?php

namespace sisScrum\Http\Controllers;

use Illuminate\Http\Request;

use sisScrum\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisScrum\Http\Requests\AvanceTareaFormRequest;

use sisScrum\Proyecto;
use sisScrum\Historia;
use sisScrum\Tarea;
use sisScrum\AvanceTarea;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class AvanceTareaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request, $idp, $idt)
    {       
        if ($request)
        {            
            $avances=DB::table('avance_tarea')
            ->where('idtarea','=',$idt)
            ->orderBy('fecha','desc')
            ->paginate(7);            

        return view("avances.index",["proyecto"=>Proyecto::findOrFail($idp),"tarea"=>Tarea::findOrFail($idt), "avances"=>$avances]);              
        }
    }
    public function create($idp,$idt)
    {
        return view("avances.create",["proyecto"=>Proyecto::findOrFail($idp),"tarea"=>Tarea::findOrFail($idt)]);
    }
    public function store(AvanceTareaFormRequest $request, $idp, $idt)
    {
        $avance=new AvanceTarea;
        $avance->idtarea=$idt;
        $mifecha = Carbon::now();
        $avance->fecha= $mifecha->toDateString();
        $avance->comentario=$request->get('comentario');        
        $avance->htrabajada=$request->get('htrabajada');     
        $avance->save();

        $totalHA=AvanceTarea::where('idtarea','=',$idt)->sum('htrabajada');
        $hayAvances=AvanceTarea::where('idtarea','=',$idt)->count();
        
        if($hayAvances==1){
            $tarea=Tarea::findOrFail($idt);
            $tarea->estado='2';
            $tarea->update();

            $historia=Historia::findOrFail($tarea->idhistoria);        
            $historia->estado='2';                        
            $historia->update();
        }
        $tarea=Tarea::findOrFail($idt);
        $tEstimado=$tarea->testimado;
        if ($totalHA>=$tEstimado) {
            $tarea->estado='3';
            $tarea->update();
        }
       
        
        return Redirect::to('proyectos/'.$idp.'/tareas/'.$idt.'/avances');
    }
    public function edit($idp, $idt,$ida)
    {
        return view("avances.edit",["proyecto"=>Proyecto::findOrFail($idp),"tarea"=>Tarea::findOrFail($idt),"tarea"=>AvanceTarea::findOrFail($ida)]);
    }
    public function update(AvanceTareaFormRequest $request,$idp,$idt,$ida)
    {
        $avance=AvanceTarea::findOrFail($ida);        
        $avance->comentario=$request->get('comentario');        
        $avance->htrabajada=$request->get('htrabajada');        
        $avance->update();
        return Redirect::to('proyectos/'.$idp.'/tareas/'.$idt.'/avances');
    }
    public function destroy($idp,$idt,$ida)
    {
        $avance=AvanceTarea::findOrFail($ida);        
        $avance->delete();
        return back();
    }
}
