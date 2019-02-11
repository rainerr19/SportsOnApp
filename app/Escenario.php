<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escenario extends Model
{   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
        'name', 'paga', 'tipo', 'caracteristicas', 'direccion', 'latitud',
        'longitud', 'detalles', 'horaBaned', 'horaOcupada', 'img','user_id'  
    ];

}
