<?php

namespace sisScrum;

use Illuminate\Database\Eloquent\Model;

class Asignado extends Model
{
    protected $table='asignado';

    protected $primaryKey='idasignado';

    public $timestamps=false;

    protected $fillable=[
        'idusuario',
    	'rol',
    	'idproyecto'    	    
    ];

    protected $guarded=[

    ];

    public function usuario()
    {
        return $this->belongsTo('sisScrum\User', 'idusuario');
    }

    public function proyecto()
    {
        return $this->belongsTo('sisScrum\Proyecto', 'idproyecto', 'idproyecto');
    }

    public function getNombreRolAttribute()
    {
        if ($this->rol=='SM') {
            return 'Scrum Master'; //Al crearse toma este valor
        }
        if ($this->rol=='DP') {
            return 'Dueño Producto';  //Cuando una de las tareas de esta historia tiene registros en avances
        }
        if ($this->rol=='Eq') {
            return 'Equipo'; //Cuando todas las tareas de esta historia tienen estado 3
        }        
        return 'Otro'; //Cuando es eliminada
    }
    
}
