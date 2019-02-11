<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asociado extends Model
{
    //protected $table = 'SubClientes'; //usar otro nombre de tabla
    //protected $timestamps = false;// no usar marca de tiempo en las tablas
    public function users()//user_id// usuario dueño
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function userAsociados()//user_asociado
    {
        return $this->belongsTo(User::class,'user_asociado');
    }
    public function escenarios()
    {
        return $this->hasMany(Escenario::class,'escenario_id');
    }
}
