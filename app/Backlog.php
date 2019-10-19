<?php

namespace sisScrum;

use Illuminate\Database\Eloquent\Model;

class Backlog extends Model
{
    protected $table='backlog';

    protected $primaryKey='idbacklog';

    public $timestamps=false;

    protected $fillable=[    	
    	'idproyecto',
        'estado'
    ];

    protected $guarded=[

    ];

    // $backlog->proyecto
    public function proyecto()
    {
        return $this->belongsTo('sisScrum\Proyecto', 'idproyecto', 'idproyecto');
    }
    public function historias()
    {
        return $this->hasMany('sisScrum\Historia','idbacklog','idbacklog');
    }
}
