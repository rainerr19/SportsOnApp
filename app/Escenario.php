<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escenario extends Model
{   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function businessHorus()
    {
        return $this->hasMany(BusinessHour::class);
    }
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
    public function escenariosCalendars()
    {
        return $this->hasMany(EscenariosCalendar::class);
    }
    protected $fillable = [
        'name', 'paga', 'tipo', 'caracteristicas', 'direccion', 'latitud',
        'longitud', 'detalles', 'horaBaned', 'horaOcupada', 'img','user_id','saveTime'  
    ];

}
