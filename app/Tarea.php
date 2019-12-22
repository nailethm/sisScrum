<?php

namespace sisScrum;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table='tarea';

    protected $primaryKey='idtarea';

    public $timestamps=false;

    protected $fillable=[
        'idhistoria',
        'idusuario',
    	'titulo',
    	'descripcion',
        'dificultad',
    	'testimado',    	
    	'estado'
    ];

    protected $guarded=[

    ];

    public function usuario()
    {
        return $this->belongsTo('sisScrum\User', 'idusuario');
    }
    public function historia()
    {
        return $this->belongsTo('sisScrum\Historia', 'idhistoria');
    }
    public function avances()
    {
        return $this->hasMany('sisScrum\AvanceTarea','idtarea','idtarea');
    }

    public function getTotalHorasTrabajadasAttribute()
    {
        
        return $this->avances()->sum('htrabajada');
    }
    public function getPorcentajeTareaAttribute()
    {
        $sumht=$this->avances()->sum('htrabajada');
        if ($sumht == '0') {
            return '0';  //Cuando todavía no tiene historias
        }
        $total_estimadas=$this->testimado;
        $porcentaje_completado=($sumht*100)/$total_estimadas;

        return number_format((float)$porcentaje_completado, 0, '.', '');
    }
    public function getNombreEstadoTareaAttribute()
    {        
        if ($this->estado=='1') {
            return 'Pendiente';
        }
        if ($this->estado=='2') {
            return 'En curso';
        }
        if ($this->estado=='3') {
            return 'Completada';
        }        
        return 'Eliminada';
    }
    public function estaAT(User $user)
    {        
        if($this->idusuario == $user->id){
            return true;
        }        
        return false;
    }
}
