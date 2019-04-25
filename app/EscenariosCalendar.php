<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EscenariosCalendar extends Model
{
    //
    
    public $timestamps = FALSE;
    protected $fillable = [
        'title', 'tipo','color','colortxt', 'detalles', 'star','end',
        'user_id',  'escenario_id'
    ];
    public function escenarios()
    {
         return $this->belongsToMany('App\Escenario', 'escenarios');
    }
}
