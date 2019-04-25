<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHour extends Model
{
    public $timestamps = FALSE;
    protected $fillable = [
     'titulo', 'semanasArray','startTime','endTime',
 ];
    public function escenarios()
    {
         return $this->belongsToMany('App\Escenario', 'escenarios');
    }
         //
}
