<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\EscenariosCalendar;
use App\businessHour;
use \App\Escenario;
use \App\User;
use \App\Interest;
use Illuminate\Http\Request;

class EscenariosCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_horas($idEscenario)
    {
        $escenario = Escenario::findOrFail($idEscenario);

        $horas =  $escenario->escenariosCalendars->toArray();
        //$busyhour = $escenario->businessHorus->toArray();

        return response()
            ->json($horas);
    }
    public function get_horas_busy($idEscenario)
    {
        $escenario = Escenario::findOrFail($idEscenario);
        $busyhour = $escenario->businessHorus->toArray();
        //dd($busyhour);
        //$busyhour = $busyhour->only('daysOfWeek','startTime','endTime')->toArray();

        return response()
            ->json($busyhour);
    }

   
}
