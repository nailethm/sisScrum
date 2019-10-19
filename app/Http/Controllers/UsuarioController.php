<?php

namespace sisScrum\Http\Controllers;

use Illuminate\Http\Request;

use sisScrum\Http\Requests;

use sisScrum\User;
use sisScrum\Asignado;
use Illuminate\Support\Facades\Redirect;
use sisScrum\Http\Requests\UsuarioFormRequest;
use DB;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['show']]);
    }
    public function index(Request $request)
    {    	
        if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$usuarios=DB::table('users')->where('name','LIKE','%'.$query.'%')
            ->where('status','=','1')        
            ->orderBy('created_at','desc')
            ->paginate(7);
            $uinactivos = User::where('status','=','0')
            ->orderBy('updated_at','desc')
            ->paginate(7);

    		return view('seguridad.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query,"uinactivos"=>$uinactivos]);	
    	}
    }
    public function create()
    {
    	return view("seguridad.usuario.create");
    }
    public function store(UsuarioFormRequest $request)
    {
    	$usuario=new User;
    	$usuario->name=strtoupper($request->get('name'));        
    	$usuario->email=$request->get('email');
        $usuario->admin=$request->get('admin');        
    	$usuario->password=bcrypt($request->get('password'));
        $usuario->CI=$request->get('CI');
        $usuario->issued=$request->get('issued');
        $usuario->address=strtoupper($request->get('address'));
        $usuario->phone=$request->get('phone');
        $usuario->company=$request->get('company');
        $usuario->occupation=strtoupper($request->get('occupation'));
        $usuario->status='1';    	    	
    	$usuario->save();

        $notification = 'Usuario creado correctamente.';

        return Redirect::to('seguridad/usuario')->with(compact('notification'));
    }
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        $misProyectos = Asignado::where('idusuario','=',$id)->with('proyecto')->orderBy('idasignado','desc')->paginate(10);
        // $misTareas = Tarea::where('idusuario','=',$id)->with('proyecto')->paginate(10);
    	return view("seguridad.usuario.show")->with(compact('usuario','misProyectos'));
    }
    public function edit($id)
    {
        return view("seguridad.usuario.edit",["usuario"=>User::findOrFail($id)]);
    }
     public function update(Request $request, $id)
    {
        $usuario=User::findOrFail($id);
        
        if ($request->has('status')) {
            $usuario->status=$request->get('status');               
            $usuario->update();

            $notification = 'Cuenta de usuario activada.';

            return Redirect::to('seguridad/usuario')->with(compact('notification'));
        }

        $this -> validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            
            'admin' => 'boolean',
            'CI' => 'numeric|digits:7',
            'company' => 'max:255',
            'occupation' => 'max:255',
            'address' => 'max:255',
            'phone' => 'numeric|digits:8',            
        ]);
    	
    	$usuario->name=strtoupper($request->get('name'));
        $usuario->email=$request->get('email');
        $usuario->admin=$request->get('admin');        
        $usuario->password=bcrypt($request->get('password'));
        $usuario->CI=$request->get('CI');
        $usuario->issued=$request->get('issued');
        $usuario->address=strtoupper($request->get('address'));
        $usuario->phone=$request->get('phone');
        $usuario->company=$request->get('company');
        $usuario->occupation=strtoupper($request->get('occupation'));    	    	
    	$usuario->update();

        $notification = 'Datos actualizados correctamente.';

    	return Redirect::to('seguridad/usuario')->with(compact('notification'));
    }
    public function destroy($id)
    {
    	$usuario=User::findOrFail($id);    	 
        $asignado = $usuario->asignados()->first();
        if (!$asignado) {
            $usuario->delete();
            $notification = 'Cuenta eliminada correctamente';

            return Redirect::to('seguridad/usuario')->with(compact('notification'));;
        }

        $usuario->status='0';
        $usuario->update();
        $notification = 'Cuenta desactivada correctamente';

        return Redirect::to('seguridad/usuario')->with(compact('notification'));;
    }

    public function pdf(Request $request)
    {        
        $usuarios = User::get(); 
        $view = \View::make('PDF.usuarios', compact('usuarios'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf -> loadHTML($view)->setPaper('letter', 'landscape');        

        return $pdf->stream('usuarios');
    }
    public function updf()
    {        
        $usuarios = User::get(); 
        $view = \View::make('PDF.usuario', compact('usuarios'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf -> loadHTML($view)->setPaper('letter');        

        return $pdf->stream('usuarios');
    }
}
