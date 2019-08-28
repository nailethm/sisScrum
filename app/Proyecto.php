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
}
