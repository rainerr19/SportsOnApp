<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Escenario;
use \App\Classes\HoraTablaCreator;

class PageController extends Controller
{
    public function main()
    {  //
        //$escenarios = Escenario::where('user_id', auth()->id())->paginate(10);
        $escenarios = Escenario::paginate(6);
        //$escenarios = Escenario::orderBy('user_id','asc')->paginate(6);
        //dd($escenarios);
        return view('web.escenarios', compact('escenarios'));
    }
    public function show($id)
    {  //Escenario::findOrFail($id)->delete();
       
        $escenario = Escenario::findOrFail($id);
        $TablaHora = new HoraTablaCreator();
        date_default_timezone_set("America/Bogota");
        $actual = strtotime("now");// stamp "now" "27-05-2018 09:01"
        $horaOc = $TablaHora -> tablaUpdate(null, 
            $escenario->saveTime, $actual);
        $actual = date("Y-m-d H:i",$actual);

        $escenario->update(["horaOcupada " => $horaOc,'saveTime' => $actual ]);
        $actual=[date("l",strtotime("now")),date("H",strtotime("now"))];

        $reservado = $TablaHora->DBsemana($escenario->horaOcupada);
        $ban = $TablaHora->DBsemana($escenario->horaBaned);
        $tabla = $TablaHora->tablaCreator($ban, $reservado,$actual,TRUE);
        return view('web.showEscenario',compact('escenario','tabla'));
    }
}
