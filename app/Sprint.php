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
    	'nota',
    	'inicio_sprint',
    	'fin_sprint',
    	'estado'
    ];

    protected $guarded=[

    ];
}
