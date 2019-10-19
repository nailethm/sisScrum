<?php

namespace sisScrum;

use Illuminate\Database\Eloquent\Model;

class AvanceTarea extends Model
{
    protected $table='avance_tarea';

    protected $primaryKey='idavance_tarea';

    public $timestamps=false;

    protected $fillable=[
        'idtarea',        
    	'fecha',
    	'comentario',    	
    	'htrabajada'
    ];

    protected $guarded=[

    ];

    public function tarea()
    {
        return $this->belongsTo('sisScrum\Tarea', 'idtarea');
    }
}
