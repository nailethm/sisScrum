<?php

namespace sisScrum;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table='users';

    protected $primaryKey='id';

    protected $fillable = [
        'name', 'email', 'password', 'admin', 'CI', 'company', 'occupation', 'address', 'address', 'phone', 'status'
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relación entre Usuario y asignado
    public function asignados()
    {
        return $this->hasMany('sisScrum\Asignado','idusuario','id');
    }
    public function tareas()
    {
        return $this->hasMany('sisScrum\Tarea','idusuario','id');
    }
    public function isAdmin()
    {        
        return (\Auth::check() && $this->admin == 1);
    }    
}
