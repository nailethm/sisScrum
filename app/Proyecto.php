<?php

namespace sisScrum;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table='proyecto';

    protected $primaryKey='idproyecto';

    public $timestamps=false;

    protected $fillable=[
    	'nombre',
    	'descripcion',
    	'inicio_proyecto',
    	'fin_proyecto',
    	'estado'
    ];

    protected $guarded=[

    ];

    public function backlog()
    {
        return $this->hasOne('sisScrum\Backlog','idproyecto','idproyecto');
    }
    // $proyecto->sprints
    public function sprints()
    {
        return $this->hasMany('sisScrum\Sprint','idproyecto','idproyecto');
    }
    public function asignados()
    {
        return $this->hasMany('sisScrum\Asignado','idproyecto','idproyecto');
    }
    public function getNombreEstadoProyectoAttribute()
    {
        if ($this->estado=='1') {
            return 'Pendiente'; //Al crearse toma este valor
        }
        if ($this->estado=='2') {
            return 'En curso';  //Cuando una de las tareas de esta historia tiene registros en avances
        }
        if ($this->estado=='3') {
            return 'Terminado'; //Cuando todas las tareas de esta historia tienen estado 3
        }        
        return 'Cancelado'; //Cuando es eliminada
    }
    public function getPorcentajeProyectoAttribute()
    {        
        $numHistorias = $this->backlog->historias()->where('estado','<>', '0')->count();
        if ($numHistorias == '0') {
            return '0';  //Cuando todavía no tiene historias
        }
        $historiasCompletadas = $this->backlog->historias()->where('estado', '3')->count();
        $porcentaje_completado=($historiasCompletadas*100)/$numHistorias;

        return number_format((float)$porcentaje_completado, 0, '.', '');
    }
    public function esDP(User $user)
    {
        $asignado = $this->asignados()->where('idusuario','=',$user->id)->first(); //Busca al usuario si está asignado al proyecto
        if($asignado==null){
            return null;
        }
        if ($asignado->rol == 'DP') { // || la conficional significa o
           return true;
        }
        return false;
    }
    public function esSM(User $user)
    {
        $asignado = $this->asignados()->where('idusuario','=',$user->id)->first(); //Busca al usuario si está asignado al proyecto
        if($asignado==null){
            return null;
        }
        if ($asignado->rol == 'SM') { // || la conficional significa o
           return true;
        }
        return false;
    }
    public function esME(User $user)
    {
        $asignado = $this->asignados()->where('idusuario','=',$user->id)->first(); //Busca al usuario si está asignado al proyecto
        if($asignado==null){
            return null;
        }
        if ($asignado->rol == 'Eq') { // || la conficional significa o
           return true;
        }
        return false;
    }    
}
