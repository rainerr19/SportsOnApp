<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\EscenarioStoreRequest;
use App\Http\Requests\EscenarioUpdateRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Escenario;
use \App\User;
use App\Asociado;
use \App\Classes\HoraTablaCreator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class EscenariosController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->id());
        if ( !(($user->hasAllRoles('super-admin'))  or ($user->hasAllRoles('admin'))) ){

           //$escenarios = $user->escenarios->count()//# de escenarios del user
           //usuario solo puede ver sus canchas
           if ($user->isAsociado()) {
                 //Asociado::all()->where('escenario_id',$escenario->id)
                $escenarios = Escenario::whereIn('id', Asociado::all()->where('user_asociado',auth()->id())->pluck('escenario_id'))->paginate(10);
                
            }else{
                $escenarios = Escenario::where('user_id', auth()->id())->paginate(10);//query
                }
           //$escenarios = $escenarios->paginate(10);//collection

         }else{

             $escenarios = Escenario::paginate(10);
        }
        return view('admin.escenarios.index', compact('escenarios'));
    }
    
    public function create()
     {   
    //     $user = User::findOrFail(auth()->id());
    //     $escenariosNum = $user->escenarios->count();//es dueño de cuantos esenarios?
    //     $numEscenariosPremission = 3; 
    //     if ($escenariosNum >= $numEscenariosPremission ) {
    //         return redirect()->route('escenarios.index', $escenario->id)
    //         ->with('info', 'No puede agregar mas canchas');
    //     }
        //crear tabla
        $TablaHora = new HoraTablaCreator();
        $ban = $TablaHora->DBsemana(""); //horrios restringidos
        $reservado = $TablaHora->DBsemana("");
        //date_default_timezone_set("America/Bogota");//horario de colombia
        //$actual=[date("l",strtotime("now")),date("H",strtotime("now"))];
        //dd($actual);//['dia de la semana','hora del dia']
        $tabla = $TablaHora->tablaCreator($ban, $reservado, [' ', '-1'],FALSE);
        return view('admin.escenarios.create',compact('tabla'));
    }

//EscenarioStoreRequest
    public function store(EscenarioStoreRequest $request)
    {   //
        
        $TablaHora = new HoraTablaCreator();
        
        $data = array();
  
        $data1 = $request->except(['ban_dia', 'ban_hora']);
        //$data1 = $request->only(['name', 'caracteristicas','detalles','paga','tipo','direccion']);
        $data2 = $request->only(['ban_dia', 'ban_hora']);

        $horasBan = $TablaHora->horasDB($data2['ban_dia'], $data2['ban_hora']);
        $horasBanDB = $TablaHora->semanaDB($horasBan);
        date_default_timezone_set("America/Bogota");
        //$actual = strtotime("now");1987-11-22 13:15:12
        $actual = date("Y-m-d H:i:s",strtotime("now"));// stamp "now" "27-05-2018 09:01"
        //dd($actual);
        $data = array_merge($data1,["horaBaned " => $horasBanDB,"user_id" => auth()->id(),  
            'saveTime' => $actual] );
        $escenario = Escenario::create($data);
        
        //******* IMAGEN */
        if ($request->file('imagen')) {
            //ruta de guadado de imagen 
            $ruta = Storage::disk('public')->put('img',$request->file('imagen'));
            //obtenemos el nombre del archivo
            //$nombre = $file->getClientOriginalName();

            $escenario->fill(['img' => asset( $ruta)])->save();
        }
        
        //$escenarios = Escenario::create($request->all());
         return redirect()->route('escenarios.edit', $escenario->id)
              ->with('info', 'Escenarios guardada con exito');
    }

 
    public function show(Escenario $escenario)
    {   
        $this->authorize('pass', $escenario);//ver solos los escenarios propios o de socios
        $TablaHora = new HoraTablaCreator();
        date_default_timezone_set("America/Bogota");
        $actual = strtotime("now");// stamp "now" "27-05-2018 09:01"
        $horaOc = $TablaHora -> tablaUpdate(null, 
            $escenario->saveTime, $actual);
        $actual = date("Y-m-d H:i:s",$actual);

        $escenario->update(["horaOcupada " => $horaOc,'saveTime' => $actual ]);
        $actual=[date("l",strtotime("now")),date("H",strtotime("now"))];

        $reservado = $TablaHora->DBsemana($escenario->horaOcupada);
        $ban = $TablaHora->DBsemana($escenario->horaBaned);
        $tabla = $TablaHora->tablaCreator($ban, $reservado,$actual,TRUE);
        return view('admin.escenarios.show', compact('escenario','tabla'));
    }


    public function edit(Escenario $escenario)
    {   $this->authorize('pass', $escenario);//editar solos los escenarios propios o de socios
        $TablaHora = new HoraTablaCreator();
        $ban = $TablaHora->DBsemana(""); //horrios restringidos
        $reservado = $TablaHora->DBsemana("");
        $tabla = $TablaHora->tablaCreator($ban, $reservado, [' ','-1'],FALSE);
         return view('admin.escenarios.edit', compact('escenario','tabla'));
    }

    public function update(EscenarioUpdateRequest $request, Escenario $escenario)
    {   
        $this->authorize('pass', $escenario);//actualizar solos los escenarios propios o de socios
        $escenario->update($request->all());
        return redirect()->route('escenarios.edit',$escenario->id)
            ->with('info', 'Escenario actualizado con exito');
    }

    public function destroy($id)
    {   
        $escenario = Escenario::findOrFail($id);
        $this->authorize('pass', $escenario);//eliminar solos los escenarios propios o de socios

         $escenario->delete();
    
        return redirect()->back()->with('info','eliminado con exito');
        // $cancha->delete();
        // return back()->with('info','eliminado con exito');
    }
}
