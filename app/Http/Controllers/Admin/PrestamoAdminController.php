<?php

namespace App\Http\Controllers\Admin;

use \App\Classes\HoraTablaCreator;
use \App\Escenario;
use \App\User;
use App\Asociado;
use App\EscenariosCalendar;
use App\Prestamo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notifiable;
use App\Notifications\PrestamoNotification;

class PrestamoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = User::findOrFail(auth()->id());
        if ($user->isAsociado()) {
            //Asociado::all()->where('escenario_id',$escenario->id)
            $escenarios = Escenario::whereIn('id', Asociado::all()->where('user_asociado',auth()->id())->pluck('escenario_id'));
            
            // $prestamos = Prestamo::where('escenario_id', '=', auth()->id())
            // ->orderBy('DateLoan', 'desc')->paginate(10);
        }else{
          $escenarios = Escenario::where('user_id', auth()->id());
        }
        if ($escenarios->count() <= 1 and $escenarios->count() > 0) {
            $prestamos = Prestamo::where('escenario_id', '=',$escenarios->first()->id )
            ->orderBy('DateLoan', 'desc')->paginate(10);
            // dd($prestamos);
        }else{
            // dd($escenarios->count());
            //ajax --- elegir listar prestamos de diferentes escenario
            $prestamos=null;
        }
        //   , compact('prestamos')
        return view('admin.prestamos.index', compact('prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aceptar($id_prestamo)
    {   
        $prestamo = Prestamo::findOrFail($id_prestamo);
        $this->authorize('owner', $prestamo->escenario);//editar solos los escenarios propios o de socios
        if ($prestamo->user->isAsociado() or  $prestamo->user->isOwner()){
            $calEscenario = EscenariosCalendar::create([
                'title'=> 'Administrador ', 'tipo'=>'Privado','color'=>'#24BD73',
                'colortxt'=>'#ffffff', 'detalles'=>null, 'start'=> $prestamo->loanDateStart,
                'end'=>$prestamo->loanDateEnd, 'user_id'=> $prestamo->user->id,
                'escenario_id'=>$prestamo->escenario->id, 
                'prestamo_id'=>$prestamo->id
            ]);
        }else{
            $calEscenario = EscenariosCalendar::create([
                'title'=> 'Reservado por usuario ', 'tipo'=>'Privado','color'=>'#28a745',
                'colortxt'=>'#ffffff', 'detalles'=>null, 'start'=> $prestamo->loanDateStart,
                'end'=>$prestamo->loanDateEnd, 'user_id'=> $prestamo->user->id,
                'escenario_id'=>$prestamo->escenario->id, 
                'prestamo_id'=>$prestamo->id
                ]);
        }
            $prestamo->estado='Prestado';
            $prestamo->save(); 
            //notificar a usuario que ha sido aceptado el prestamo
            $prestamo->user->notify(new PrestamoNotification($prestamo->estado));// cambio de estado
            // dd($calEscenario->id);
        return redirect()->route('prestamos.index')
                ->with('info', 'Horario guardado');
       
        //dd( $id_prestamo);
        //
    }

    public function rechazar($id_prestamo)
    {   
        $prestamo = Prestamo::findOrFail($id_prestamo);
        $this->authorize('owner', $prestamo->escenario);//editar solos los escenarios propios o de socios
        $prestamo->update(['estado'=> 'Rechazado']);
        //notificar a usuario que ha sido aceptado el prestamo
        $prestamo->user->notify(new PrestamoNotification($prestamo->estado));// cambio de estado
        //
        return redirect()->route('prestamos.index')
             ->with('info', 'Horario guardado');
    }
    public function devolver($id_prestamo)
    {   
        $prestamo = Prestamo::findOrFail($id_prestamo);
        $this->authorize('owner', $prestamo->escenario);//editar solos los escenarios propios o de socios
        $calEscenario=$prestamo->calendar;
        $calEscenario->delete();
        $prestamo->estado='Devolución';
        $prestamo->save();
        // $prestamo->update(['estado'=> 'Devolución',
        //  'escenarios_calendars_id'=>NULL]);
        //notificar a usuario devolucion del prestamo
        $prestamo->user->notify(new PrestamoNotification($prestamo->estado));// cambio de estado
        // $user->notify(new PrestamoNotification($estado));
       
        return redirect()->route('prestamos.index')
                 ->with('info', 'Devolución exitosa');
        
      
        //
    }

}
