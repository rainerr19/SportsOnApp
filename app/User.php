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
        'name','apellidos','cel','birthdate', 'email', 'password', 'img', 'sexo'
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
    public function interests(){

        return $this->belongsToMany('App\Interest','interests_user');
        
        //interest_id 	user_id  interests_user 
        // (modelo a relacionar, nombre de tabla pivot, llave propia, llave foranea del modelo a realcionar)
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
