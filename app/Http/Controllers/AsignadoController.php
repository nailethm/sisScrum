<?php

namespace sisScrum\Http\Controllers;

use Illuminate\Http\Request;

use sisScrum\Http\Requests;

use sisScrum\Proyecto;
use sisScrum\User;
use sisScrum\Asignado;
use Illuminate\Support\Facades\Redirect;
use sisScrum\Http\Requests\AsignadoFormRequest;
use DB;

class AsignadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request,$idp)
    {    	
        if ($request)
    	{    		
    		// $asignados=DB::table('asignado as a')
    		// ->join('users as u','a.idusuario','=','u.id')
    		// ->select('a.idasignado','u.name','a.rol','a.idproyecto')
      //       ->where('a.idproyecto','=',$idp)            
      //       ->orderBy('idasignado','desc')
      //       ->get();
            $asignados=Asignado::where('idproyecto','=',$idp)->with('usuario')->get();//Mi primera prueba exitosa uniendo MODELOS

            $query2=trim($request->get('searchText'));            
            $noasignados=User::whereDoesntHave('asignados',function ($query) use ($idp){$query->where('idproyecto','=',$idp);})
            ->where('name','LIKE','%'.$query2.'%')
            ->get();
            $searchText=$query2;
            $proyecto=Proyecto::findOrFail($idp);           
                   
    		return view('participante.index')->with(compact('noasignados','asignados','searchText','proyecto'));	
    	}
    }

    public function store(AsignadoFormRequest $request,$idp)
    {    	
    	$asignado=new Asignado;
    	$asignado->idusuario=$request->get('idusuario');
    	$asignado->rol=$request->get('rol');        
    	$asignado->idproyecto=$request->get('idproyecto');    	    	
    	$asignado->save();

    	return Redirect::to('proyectos/'.$idp.'/participantes');
    }
    public function show($idp, $ida)
    {
               
        
        return view("historias.show")->with(compact('hola'));
    }
    public function destroy($idp,$ida)
    {
    	$usuario=Asignado::findOrFail($ida);
    	$usuario->delete();
    	return Redirect::to('proyectos/'.$idp.'/participantes');
    }
}
