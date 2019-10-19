<?php

namespace sisScrum;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $table='historia';

    protected $primaryKey='idhistoria';

    public $timestamps=false;

    protected $fillable=[
    	'idsprint',
        'idusuario',
        'idbacklog',
    	'actor',
    	'requerimiento',
    	'funcionalidad',
    	'prioridad',
    	'notas',
    	'creador',
    	'estado',
    	'fecha_creacion'
    ];

    protected $guarded=[

    ];

    public function backlog()
    {
        return $this->belongsTo('sisScrum\Backlog', 'idbacklog', 'idbacklog');
    }
    public function tareas()
    {
        return $this->hasMany('sisScrum\Tarea','idhistoria','idhistoria');
    }
    public function sprint()
    {
        return $this->belongsTo('sisScrum\Sprint', 'idsprint', 'idsprint');
    }
    public function getNombreEstadoHistoriaAttribute()
    {
        if ($this->estado=='1') {
            return 'Pendiente'; //Al crearse toma este valor
        }
        if ($this->estado=='2') {
            return 'En curso';  //Cuando una de las tareas de esta historia tiene registros en avances
        }
        if ($this->estado=='3') {
            return 'Completada'; //Cuando todas las tareas de esta historia tienen estado 3
        }        
        return 'Default'; //Cuando es eliminada
    }
    public function getPorcentajeHistoriaAttribute()
    {
        $sumht=$this->avances()->sum('htrabajada');
        $total_estimadas=$this->testimado;
        $porcentaje_completado=($sumht*100)/$total_estimadas;

        return number_format((float)$porcentaje_completado, 0, '.', '');
    }
}
