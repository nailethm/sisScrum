<?php

namespace sisScrum\Http\Controllers;

use Illuminate\Http\Request;

use sisScrum\Http\Requests;
use sisScrum\Proyecto;
use sisScrum\Backlog;
use sisScrum\Sprint;
use Illuminate\Support\Facades\Redirect;
use sisScrum\http\Requests\ProyectoFormRequest;
use DB;
use Carbon\Carbon;

class ProyectoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['reportes']]);
    }
    public function index(Request $request)
    {
    	// dd($request);
        if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$proyectos=Proyecto::where('nombre','LIKE','%'.$query.'%')
            ->where('estado','<>','0')
            ->orderBy('idproyecto','desc')
            ->paginate(7);
            $searchText = $query;
    		return view('proyecto.index')->with(compact('proyectos','searchText'));	
    	}
    }
    public function create()
    {
    	return view("proyecto.create");
    }
    public function store(ProyectoFormRequest $request)
    {
    	$proyecto=new Proyecto;
    	$proyecto->nombre=$request->get('nombre');
    	$proyecto->descripcion=$request->get('descripcion');        
    	$proyecto->inicio_proyecto=$request->get('inicio_proyecto');
    	$proyecto->fin_proyecto=$request->get('fin_proyecto');
    	$proyecto->estado='1';
    	$proyecto->save();

        $backlog=new Backlog;
        $backlog->idproyecto=$proyecto->idproyecto;        
        $backlog->estado='1';
        $backlog->save();

    	return Redirect::to('proyectos');
    }
    public function show($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $sprintActual = $proyecto->sprints()->where('estado','=','2')->first();                        
        if ($sprintActual==null) {
            $sprintActual = null;
            $historiasPendientes = null;
            $historiasProgreso = null;                    
            $historiasTerminadas = null;
            return view("proyecto.show")->with(compact('proyecto','sprintActual','historiasPendientes','historiasProgreso','historiasTerminadas'));
        }
        $historiasPendientes = $sprintActual->historias()->where('estado','=','1')->get();
        $historiasProgreso = $sprintActual->historias()->where('estado','=','2')->get();        
        $historiasTerminadas = $sprintActual->historias()->where('estado','=','3')->get();
    	return view("proyecto.show")->with(compact('proyecto','sprintActual','historiasPendientes','historiasProgreso','historiasTerminadas'));
    }
    public function edit($id)
    {
    	return view("proyecto.edit",["proyecto"=>Proyecto::findOrFail($id)]);
    }
    public function update(ProyectoFormRequest $request,$id)
    {
    	$proyecto=Proyecto::findOrFail($id);
    	$proyecto->nombre=$request->get('nombre');
    	$proyecto->descripcion=$request->get('descripcion');
    	$proyecto->inicio_proyecto=$request->get('inicio_proyecto');
    	$proyecto->fin_proyecto=$request->get('fin_proyecto');
    	$proyecto->update();
    	return Redirect::to('proyectos');
    }
    public function destroy($id)
    {
    	$proyecto=Proyecto::findOrFail($id);
    	$proyecto->estado='0';
    	$proyecto->update();
    	return Redirect::to('proyectos');
    }
    public function pdf()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        $proyectos = Proyecto::get(); 
        $view = \View::make('PDF.usuario', compact('proyectos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf -> loadHTML($view);        

        return $pdf->stream('proyectos');
    }
    public function reportes(Request $request)
    {
        $query=trim($request->get('searchText'));
        $proyectos=Proyecto::where('nombre','LIKE','%'.$query.'%')
        ->where('estado','<>','0')
        ->orderBy('idproyecto','desc')
        ->paginate(7);
        $searchText = $query;
        return view('seguridad.proyecto.index')->with(compact('proyectos','searchText')); 
    }
}
