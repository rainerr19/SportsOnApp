<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escenario extends Model
{   
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function businessHorus()
    {
        return $this->hasMany(BusinessHour::class);
    }
    public function pestamos()
    {
        return $this->HasMany('App\Prestamo');
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
        'longitud', 'detalles', 'img','user_id'  
    ];

}
