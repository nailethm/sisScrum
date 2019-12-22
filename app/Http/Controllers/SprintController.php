<?php

namespace sisScrum\Http\Controllers;

use Illuminate\Http\Request;

use sisScrum\Http\Requests;
use sisScrum\Proyecto;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisScrum\Http\Requests\SprintFormRequest;
use sisScrum\Backlog;
use sisScrum\Sprint;
use sisScrum\Historia;
use sisScrum\Tarea;
use sisScrum\AvanceTarea;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class SprintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request, $idp)
    {
        if ($request)
    	{
            $sprints = Sprint::where('idproyecto','=',$idp)
            ->orderBy('titulo','desc')
            ->paginate(7);                            		

            $proyecto=Proyecto::findOrFail($idp);
                        
            return view('sprints.index')->with(compact('proyecto','sprints'));	
    	}
    }
    public function create($idp)
    {
    	return view("sprints.create",["proyecto"=>Proyecto::findOrFail($idp)]);
    }
    public function store(SprintFormRequest $request, $idp)
    {
    	$sprint=new Sprint;
    	$sprint->idproyecto=$request->get('idproy');
    	$sprint->titulo=$request->get('titulo');
    	$sprint->nota=$request->get('nota');
    	$sprint->inicio_sprint=$request->get('inicio_sprint');
    	$sprint->fin_sprint=$request->get('fin_sprint');
    	$sprint->estado='1';
    	$sprint->save();
    	return Redirect::to('proyectos/'.$idp.'/sprints');
    }
    public function show($idp, $ids)
    {
        $proyecto = Proyecto::findOrFail($idp);
        $sprint = Sprint::findOrFail($ids);
        if ($sprint->porcentaje_sprint=='100') {                
            $sprint->estado='3';
            $sprint->update();
        }
        if ($sprint->historias->count() <>'0') {                
            $sprint->estado='2';
            $sprint->update();
        }
        $backlog = Backlog::where('idproyecto','=',$idp)->first();
        $idb=$backlog->idbacklog;
        $historias = Historia::where('idbacklog','=',$idb)
            ->where('idsprint','=','0')
            ->get(); //todas las historias del Backlog excepto las que han sido seleccionadas
        $selecHistorias = Historia::where('idbacklog','=',$idb)
            ->where('idsprint','=',$ids)
            ->get(); //todas las historias del Backlog excepto las que han sido seleccionadas
        
                
    	return view("sprints.show")->with(compact('proyecto', 'sprint', 'historias', 'selecHistorias'));
    }
    public function edit($id1, $id2)
    {
    	return view("sprints.edit",["sprint"=>Sprint::findOrFail($id2)]);
    }
    public function update(SprintFormRequest $request,$idp,$ids)
    {
    	$sprint=Sprint::findOrFail($ids);
        if (!$request->has('estado')) {
            $sprint->idproyecto=$request->get('idproy');
            $sprint->titulo=$request->get('titulo');
            $sprint->nota=$request->get('nota');
            $sprint->inicio_sprint=$request->get('inicio_sprint');
            $sprint->fin_sprint=$request->get('fin_sprint');
            $sprint->update();

            return Redirect::to('proyectos/'.$idp.'/sprints');
        }
        $sprint->estado=$request->get('estado');
        $sprint->update();
    	
        return Redirect::to('proyectos/'.$idp.'/sprints/'.$ids.'/show');
    }
    public function destroy($id1,$id2)
    {
    	$sprint=Sprint::findOrFail($id2);
    	$sprint->delete();
    	return Redirect::to('proyectos/'.$id1.'/sprints');
    }
    public function Chartjs($idp,$ids)
    {
        $sprint = Sprint::find($ids);
        $proyecto = Proyecto::find($idp);
        $historias = $sprint->historias()->get();
        $TRT = 0;
        foreach ($historias as $historia) {
            $TRT = $TRT + $historia->tareas()->where('estado','<>','0')->sum('testimado');//Tiempo Restante Total           
        }        
        $HEI = $TRT; //Horas Estimadas Ideales
        $HER = $TRT; //Horas Estimadas Reales

        $inicioSprint = Carbon::parse($sprint->inicio_sprint); // Debemos obtener fecha inicio_sprint del Sprint
        $finSprint = Carbon::parse($sprint->fin_sprint); // Debemos obtener fecha fin_sprint del Sprint

        $totalDias = $inicioSprint->diffInDays($finSprint); //Obtenemos cuantos dias tiene ese rango de fechas        
        
        $dias = array(); //Inicializamos array para obtener todos los dias entre inicio_sprint a fin_sprint
        $curvaIdeal = array();
        $curvaReal=array();
        if ($TRT == 0) {
            return view("sprints.chartjs")->with(compact('proyecto','TRT','dias', 'curvaIdeal', 'curvaReal'));
        }
        while ($inicioSprint->lte($finSprint)){
            $dias[] = $inicioSprint->format('d-m'); //$month = array('Jan', 'Feb', 'Mar', 'Apr', 'May');              
            $sumaReal = 0;          
            foreach ($historias as $historia) {
                $tareas=$historia->tareas()->where('estado','<>','0')->get();//Seleccionar tareas DONDE su estado es diferente de 0
                foreach ($tareas as $tarea) {
                    $sumAT = $tarea->avances()->where('fecha','=',$inicioSprint)->sum('htrabajada');//Seleccionar tareas DONDE su estado es diferente de 0
                    $sumaReal = $sumaReal + $sumAT;
                }
            }
            $curvaIdeal[] = number_format((float)$HEI, 1, '.', '');
            $HEI=$HEI-($TRT/$totalDias);
            $HER = $HER - $sumaReal;
            $curvaReal[] = $HER;                        
            $inicioSprint->addDay();//Actualiza $starSprint con la fecha del ciclo
        }
        // dd(count($curvaReal));
        return view("sprints.chartjs")->with(compact('proyecto','TRT','dias', 'curvaIdeal', 'curvaReal','sprint'));

    }
}
