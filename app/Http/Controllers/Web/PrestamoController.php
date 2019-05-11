<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePrestamoRequest;
use App\Http\Controllers\Controller;
use App\Prestamo;
use \App\Escenario;
use \App\User;

class PrestamoController extends Controller
{
    
    public function create($escenario_id,CreatePrestamoRequest $request)
    {
        // $user = User::findOrFail(auth()->id());
        // dd($user->isAsociado() or  $user->isOwner());
        //$escenario = Escenario::findOrFail($escenario_id);
        date_default_timezone_set("America/Bogota");//horario de colombia
        $actual = date("Y-m-d H:i",strtotime("now"));
        $dateStart = explode(",",$request->input('dateStart'));
        $dateEnd = explode(",",$request->input('dateEnd'));
        foreach ($dateStart as $key => $value) {
            $prestamo = Prestamo::create(['loanDateStart'=>$dateStart[$key],
               'loanDateEnd'=>$dateEnd[$key], 'estado'=>'Por Confirmar',
               'user_id'=>(auth()->id()),'escenario_id'=>$escenario_id,
                'DateLoan'=>$actual]);
        }
        return redirect()->route('web.historial')
            ->with('info', 'Prestamo creado con éxito,
                 Espera confirmación por correo');
    }
    public function show($id_prestamo)
    {   
        $prestamo = Prestamo::findOrFail($id_prestamo);
        if (auth()->id() != $prestamo->user_id) {
            $this->authorize('show', $prestamo);//revisar que pasa con la politicy
        }
        return view('web.historialshow',compact('prestamo'));
    }

  
    public function index()
    {
        //$prestamos = User::findOrFail(auth()->id())->prestamos->sortByDesc('DateLoan');
        $prestamos = Prestamo::where('user_id', '=', auth()->id())
            ->orderBy('DateLoan', 'desc')->paginate(10);

        return view('web.historial',compact('prestamos'));
    }

    // public function edit(Prestamo $prestamo)
    // {
    //     //
    // }

    
    // public function update(Request $request, Prestamo $prestamo)
    // {
    //     //
    // }

}
