<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHour extends Model
{
    public $timestamps = FALSE;
    protected $fillable = [
     'daysOfWeek',//dias de la semana
     'startTime',
     'endTime',
     'escenario_id',
 ];
    public function escenarios()
    {
         return $this->belongsToMany('App\Escenario', 'escenarios');
    }
         //
}
