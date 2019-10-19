<?php

namespace sisScrum\Http\Controllers;

use Illuminate\Http\Request;

use sisScrum\Http\Requests;
use sisScrum\User;
use sisScrum\Proyecto;

class PdfController extends Controller
{
    public function index(Request $request)
    {        
        $proyectos=Proyecto::where('estado','<>','0')
        ->orderBy('idproyecto','desc')
        ->paginate(7);
        
        return view('pdf.index')->with(compact('proyectos')); 
    }
	  public function crearPDF($datos,$vistaUrl) 
    {
        $data = $datos;
        $date = date('Y-m-d');        
        $view =  \View::make($vistaUrl, compact('data', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf -> loadHTML($view)->setPaper('letter', 'landscape');
        return $pdf->stream('reporte');
    }
 
    public function reporteProyectos() 
    {
        $vistaUrl = "PDF.listado_proyectos";
        $proyectos = Proyecto::all();

        return $this -> crearPDF($proyectos, $vistaUrl);
    }
    public function reporteUsuarios(Request $request) 
    {
        $opcion = $request->get('ureport');
        if ($opcion=='u1') {
            $usuarios = User::where('status','1')->get();
            $vistaUrl = "PDF.listado_usuarios";        
            return $this -> crearPDF($usuarios, $vistaUrl);
        }        
    }
    public function reporteUsuario($idu) 
    {
        $vistaUrl = 'PDF.detalle_usuario';
        $usuario = User::findorfail($idu)->first();

        return $this -> crearPDF($usuario, $vistaUrl);
    }
}
