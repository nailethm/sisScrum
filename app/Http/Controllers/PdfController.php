<?php

namespace sisScrum\Http\Controllers;

use Illuminate\Http\Request;

use sisScrum\Http\Requests;
use sisScrum\User;
use sisScrum\Asignado;
use sisScrum\Proyecto;
use sisScrum\Backlog;
use sisScrum\Historia;
use sisScrum\Sprint;
use sisScrum\Tarea;
use DB;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {        
        $proyectos=Proyecto::where('estado','<>','0')
        ->orderBy('nombre','asc')
        ->paginate(7);
        $usuarios = User::where('status','1')->orderBy('created_at','asc')->get();
        $iAño = $usuarios->first()->created_at->format('Y');
        $fAño = Carbon::now()->format('Y');;
                
        
        return view('pdf.index')->with(compact('proyectos', 'usuarios','iAño', 'fAño')); 
    }
	public function crearPDF($datos1, $vistaUrl, $datos2, $datos3) 
    {
        $data1 = $datos1;
        $date = date('Y-m-d'); 
        if ($datos3 <> null) {            
            $data3 = $datos3;            
            $data2 = $datos2;
            $view =  \View::make($vistaUrl, compact('data1', 'data2', 'data3', 'date'))->render();                         
        }
        if ($datos2 <> null && $datos3 == null) {
            $data2 = $datos2;            
            $view =  \View::make($vistaUrl, compact('data1', 'data2','date'))->render();
        }
        if ($datos1 <> null && $datos2 == null){            
            $view =  \View::make($vistaUrl, compact('data1', 'date'))->render();
        }    
        $pdf = \App::make('dompdf.wrapper');        
        $pdf -> loadHTML($view)->setPaper('letter', 'landscape');
        return $pdf->stream('reporte');
    }
 
    public function reporteProyectos(Request $request) 
    {                
        $idp = $request->get('preporte');
        $opcion = $request->get('preporte-o');
        $proyecto = Proyecto::findOrFail($idp);
        $asignados = $proyecto->asignados()->get(); //$asignados = Asignado::where('idproyecto',$idp)->get();        
        $backlog = $proyecto->backlog()->first();        
        $idb = $backlog->idbacklog;        
        $historias = $backlog->historias()->where('estado','<>','0')->orderBy('estado','desc')->get();                

        if ($opcion == 'p1') {
            $vistaUrl = 'PDF.pila_producto'; //PILA DEL PRODUCTO               

            return $this -> crearPDF($historias, $vistaUrl, $proyecto, $asignados);            
        }
        if ($opcion == 'p2') {
            $vistaUrl = 'PDF.listado_sprints'; //SPRINTS DEL PROYECTO
            $sprints = Sprint::where('idproyecto',$idp)->where('estado','<>','0')->orderBy('idsprint','asc')->get();         

            return $this -> crearPDF($sprints, $vistaUrl, $proyecto, $asignados);
        }
        if ($opcion == 'p3') {
            $vistaUrl = 'PDF.listado_tareas'; //TAREAS DE TODO EL PROYECTO     

            return $this -> crearPDF($historias, $vistaUrl, $proyecto, $asignados);
        }
        if ($opcion == 'p4') {
            $vistaUrl = 'PDF.listado_avances'; //AVANCES DE TODO EL PROYECTO
            $tareas = $historias->tareas()->where('estado','<>','0')->orderBy('estado','desc')->get();          

            return $this -> crearPDF($tareas, $vistaUrl, $proyecto, $asignados);
        }
    }
    public function reporteUsuarios(Request $request) 
    {        
        $opcion = $request->get('ureporte');
        if ($opcion=='u1') {
            $idu = $request->get('ureporte-u');            
            $usuario = User::where('id',$idu)->first();
            $misProyectos = Asignado::where('idusuario','=',$idu)->with('proyecto')->orderBy('idasignado','desc')->get();            
            $vistaUrl = "PDF.detalle_usuario"; //PAGINA DE UN USUARIO

            return $this -> crearPDF($usuario, $vistaUrl, $misProyectos, null);
        }
        if ($opcion=='u2') {
            $idp = $request->get('ureporte-p');
            $proyecto = Proyecto::where('idproyecto',$idp)->first();
            $participantes = Asignado::where('idproyecto','=',$idp)->with('usuario')->orderBy('rol','desc')->get();                       
            $vistaUrl = "PDF.usuarios_proyecto";

            return $this -> crearPDF($proyecto, $vistaUrl, $participantes, null);
        }
        if ($opcion=='u3') {
            $mes = $request->get('ureporte-m');
            $nombresMes = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            $nombreMes = $nombresMes[$mes-1];
            $usuarios = User::where('status','1')->get();
            $vistaUrl = "PDF.mensual_usuarios";

            return $this -> crearPDF($usuarios, $vistaUrl, $mes, $nombreMes);
        }
        if ($opcion=='u4') {
            $año = $request->get('ureporte-y');                        
            $usuarios = User::where('status','1')->where( DB::raw('YEAR(created_at)'), '=', $año )->get();
            $vistaUrl = "PDF.anual_usuarios";

            return $this -> crearPDF($usuarios, $vistaUrl, $año, null);
        }        
    }
    public function reporteUsuario($idu) 
    {
        $vistaUrl = 'PDF.detalle_usuario'; //PAGINA DE UN USUARIO
        $usuario = User::findorfail($idu)->first();
        $misProyectos = Asignado::where('idusuario','=',$idu)->with('proyecto')->orderBy('idasignado','desc')->get();

        return $this -> crearPDF($usuario, $vistaUrl, $misProyectos, null);
    }
    public function reportePilaProducto($idp) 
    {
        $vistaUrl = 'PDF.pila_producto'; //PILA DEL PRODUCTO
        $proyecto = Proyecto::findOrFail($idp);
        $asignados = $proyecto->asignados()->get();        
        $backlog = $proyecto->backlog()->first();        
        $idb = $backlog->idbacklog;        
        $historias = $backlog->historias()->where('estado','<>','0')->orderBy('estado','desc')->get();       

        return $this -> crearPDF($historias, $vistaUrl, $proyecto, $asignados); 
    }
    public function reportePilaSprint($ids) 
    {
        $vistaUrl = 'PDF.pila_sprint'; //PILA DE UN SPRINT       
        $historias = Historia::where('idsprint',$ids)->where('estado','<>','0')->orderBy('prioridad','asc')->get();
        $sprint = Sprint::findOrFail($ids)->first();         

        return $this -> crearPDF($historias, $vistaUrl, $sprint, null);
    }
    
    public function reporteTareas($idh) 
    {
        $vistaUrl = 'PDF.tareas_historia';
        $historia = Historia::findOrFail($idh); //PAGINA DE UNA HISTORIA
        $idb = $historia->idbacklog;
        $proyecto = Backlog::findOrFail($idb)->proyecto()->first();                
        $asignados = $proyecto->asignados()->get();      

        return $this -> crearPDF($historia, $vistaUrl, $proyecto, $asignados);
    }
    public function reporteAvances($idt) 
    {
        $vistaUrl = 'PDF.avances_tarea'; //PAGINA DE UNA TAREA
        $tarea = Tarea::findOrFail($idt);
        $idb = $tarea->historia->idbacklog;        
        $proyecto = Backlog::findOrFail($idb)->proyecto()->first();                
        $asignados = $proyecto->asignados()->get();      

        return $this -> crearPDF($tarea, $vistaUrl, $proyecto, $asignados);
    }
}
