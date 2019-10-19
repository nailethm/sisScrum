<?php

namespace sisScrum\Http\Controllers;

use Illuminate\Http\Request;

use sisScrum\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisScrum\Http\Requests\BacklogFormRequest;
use sisScrum\Backlog;
use sisScrum\Proyecto;
use sisScrum\Historia;
use DB;

class BacklogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request, $idp)
    {
        if ($request)
    	{   
    		$backlog=Backlog::where('idproyecto','=',$idp)->first();
    		$idbacklog=$backlog->idbacklog;    		
    		$historias=DB::table('historia')       
            ->where('idbacklog','=',$idbacklog)
            ->where('estado','<>','0')
            ->orderBy('prioridad','asc')
            ->paginate(7); 
            $proyecto=Proyecto::findOrFail($idp);           
            return view('backlog.index')->with(compact('historias','proyecto'));	
    	}
    }
    public function store(Request $request,$idp,$ids)
    {       
        $historia=historia::findOrFail($request->get('idhistoria'));
        $historia->idsprint=$ids;        
        // $historia->estado=$request->get('estado');
        $historia->update();
        return Redirect::to('proyectos/'.$idp.'/sprints/'.$ids.'/show');
    }
    
}
