<?php

namespace sisScrum;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $table='sprint';

    protected $primaryKey='idsprint';

    public $timestamps=false;

    protected $fillable=[
    	'idproyecto',
        'titulo',
    	'nota',
    	'inicio_sprint',
    	'fin_sprint',
    	'estado'
    ];

    protected $guarded=[

    ];

    //$sprint->proyecto
    public function proyecto()
    {
        return $this->belongsTo('sisScrum\Proyecto', 'idproyecto', 'idproyecto');
    }
    public function historias()
    {
        return $this->hasMany('sisScrum\Historia','idsprint','idsprint');
    }
    public function getNombreEstadoSprintAttribute()
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
        return 'No seleccionada'; //Cuando es eliminada
    }
    public function getPorcentajeSprintAttribute()
    {
        $totalH=$this->historias()->count();
        if ($totalH=='0') {
            return '0';  //Cuando todavía no tiene historias
        }
        $historiaC=$this->historias()->where('estado', '3')->count();
        $porcentaje_completado=($historiaC*100)/$totalH;

        return number_format((float)$porcentaje_completado, 0, '.', '');
    }
}
