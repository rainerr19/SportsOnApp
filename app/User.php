<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function escenarios()
    {
        return $this->hasMany(Escenario::class);
    }
    public function asociados()
    {
        return $this->hasMany(Asociado::class);
    }
    public function isAsociado()
    {   //$asociados = Asociado::all();
        $asociado = Asociado::all()->where('user_asociado',$this->id); 
        return $asociado->isNotEmpty();
    }
    
}
