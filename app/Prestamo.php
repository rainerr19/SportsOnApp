<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    //
    public $timestamps = FALSE;
    protected $fillable = [ 
        'loanDateStart',
               'loanDateEnd', 'estado',
               'user_id','escenario_id','DateLoan'
     ];
     public function escenario()
     {
          return $this->belongsTo('App\Escenario', 'escenario_id');
     }
     public function user()
     {
         return $this->belongsTo('App\User','user_id');
          //interest_id 	user_id  interests_user 
     }
}
