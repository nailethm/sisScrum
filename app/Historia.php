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
}
