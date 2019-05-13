<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class price extends Model
{
    //
    public $timestamps = FALSE;
    protected $fillable = [ 
        'startHour',
        'endHour',
        'dias',
        'hourPrice',
        'color',
        'escenario_id',
     ];
     public function escenarios()
    {
         return $this->belongsToMany('App\Escenario', 'escenarios');
    }
}

