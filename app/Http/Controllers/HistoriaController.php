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
use DB;

class HistoriaController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$historias=DB::table('historia as h')
    		->join('sprint as s','h.idsprint','=','s.idsprint')
    		->join('proyecto as p','p.idproyecto','=','s.idproyecto')
    		->select('h.idhistoria','s.idsprint','h.actor','h.requerimiento','h.funcionalidad','h.prioridad','h.notas','h.estado','h.fecha_creacion','p.nombre')
    		->where('requerimiento','LIKE','%'.$query.'%')
            ->where('estado','=','1')
            ->orderBy('prioridad','desc')
            ->paginate(7);
    		return view('historia.index',["historias"=>$historias,"searchText"=>$query]);	
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
        // $ifecha=Carbon::createFromFormat('d-m-Y', $request->inicio_proyecto)->toDateString();
        // $ifecha=$proyecto->inicio_proyecto;
        // $ffecha=Carbon::createFromFormat('d-m-Y', $request->fin_proyecto)->toDateString();
        // $ffecha=$proyecto->fin_proyecto;
    	$proyecto->inicio_proyecto=$request->get('inicio_proyecto');
    	$proyecto->fin_proyecto=$request->get('fin_proyecto');
    	$proyecto->estado='1';
    	$proyecto->save();
    	return Redirect::to('proyecto');
    }
    public function show($id)
    {
    	return view("proyecto.show",["proyecto"=>Proyecto::findOrFail($id)]);
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
    	return Redirect::to('proyecto');
    }
    public function destroy($id)
    {
    	$proyecto=Proyecto::findOrFail($id);
    	$proyecto->estado='0';
    	$proyecto->update();
    	return Redirect::to('proyecto');
    }
}
