<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\EscenarioStoreRequest;
use App\Http\Requests\EscenarioUpdateRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \App\Escenario;
use \App\User;
use \App\Asociado;
use \App\price;
use App\BusinessHour;
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
        // $TablaHora = new HoraTablaCreator();
        // $ban = $TablaHora->DBsemana(""); //horrios restringidos
        // $reservado = $TablaHora->DBsemana("");
        //date_default_timezone_set("America/Bogota");//horario de colombia
        //$actual=[date("l",strtotime("now")),date("H",strtotime("now"))];
        //dd($actual);//['dia de la semana','hora del dia']
        // $tabla = $TablaHora->tablaCreator($ban, $reservado, [' ', '-1'],FALSE);
        $dias = ["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"
        ,"Domingo","Lunes a viernes","Toda la semana"];
         $dbdias=['[1]','[2]','[3]','[4]','[5]','[6]','[0]','[1,2,3,4,5]',
         '[0,1,2,3,4,5,6,7]'];
        return view('admin.escenarios.create',compact('dias'));
    }

//EscenarioStoreRequest
    public function store(EscenarioStoreRequest $request)
    {           // $TablaHora = new HoraTablaCreator();

        $data1 = $request->except(['bussinessDay','bussinesshours', 'price']);
        $data = array_merge($data1,["user_id" => auth()->id()] );
        $escenario = (new Escenario)->fill($data);
        //$escenario = Escenario::create($data);
        //******* IMAGEN */
        $escenario->img = $request->file('imagen')->store('public/EscenarioImg');
        $escenario->save();
       //ruta de guadado de imagen 
       //$ruta = Storage::disk('public')->put('img',$request->file('imagen'));
       //obtenemos el nombre del archivo
       //$nombre = $file->getClientOriginalName();
       //$escenario->fill(['img' => asset( $ruta)])->save();
       $dias = ["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"
       ,"Domingo","Lunes a viernes","Toda la semana"];
       $dbdias=['[1]','[2]','[3]','[4]','[5]','[6]','[0]','[1,2,3,4,5]',
       '[0,1,2,3,4,5,6,7]'];
        $bussinessDay = $request['bussinessDay'];
        $bussinesshours = $request['bussinesshours'];
        if ($bussinessDay != null and $bussinesshours != null ) {
            # code...
            $bussinessDay = explode(",",$bussinessDay);
            $bussinesshours = explode(",",$bussinesshours);
            $hours = [];
            for ($i=0; $i < sizeof($bussinessDay); $i++) { 
                
                $hours = explode("-", $bussinesshours[$i]);
                
                BusinessHour::create([
                    'daysOfWeek'=> $dbdias[array_search($bussinessDay[$i],$dias)],//dias de la semana
                    'startTime'=> $hours[0],
                    'endTime'=> $hours[1],
                    'escenario_id' => $escenario->id,
                ]);
            }
        }
        // dd($bussinessDay);       
        return redirect()->route('escenarios.edit', $escenario->id)
             ->with('info', 'Escenarios guardada con exito');
    }


    public function edit(Escenario $escenario)
    {   $this->authorize('owner', $escenario);//editar solos los escenarios propios o de socios
        // BusinessHour
        $dbDias=['[1]','[2]','[3]','[4]','[5]','[6]','[0]','[1,2,3,4,5]',
         '[0,1,2,3,4,5,6,7]'];
        // dd($bussinesshours);
        $precios = $escenario->prices;
        // dd($precios->where('dias','Lunes'));
        // $prestamos = Prestamo::where('escenario_id', '=',$escenarios->first()->id )
        // ->orderBy('DateLoan', 'desc')->paginate(10);
        $dias = ["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"
        ,"Domingo","Lunes a viernes","Toda la semana"];
         return view('admin.escenarios.edit', compact('escenario','dias','dbDias','precios'));
    }

    public function update(EscenarioUpdateRequest $request, Escenario $escenario)
    {   
        $this->authorize('owner', $escenario);//actualizar solos los escenarios propios o de socios
        if ($request->hasFile('imagen')) {
            Storage::delete($escenario->img);
            $escenario->img = $request->file('imagen')->store('public/EscenarioImg');
        }
        $data1 = $request->except(['bussinessDay','bussinesshours','price',
        "pday",  "phour1",  "phour2",  "prices",  "pcolor", ]);
        $dias = ["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"
        ,"Domingo","Lunes a viernes","Toda la semana"];
        $dbdias=['[1]','[2]','[3]','[4]','[5]','[6]','[0]','[1,2,3,4,5]',
        '[0,1,2,3,4,5,6]'];
        $bussinessDay = $request['bussinessDay'];
        $bussinesshours = $request['bussinesshours'];
        if ($bussinessDay != null and $bussinesshours != null ) {
            # code...
            $bussinessDay = explode(",",$bussinessDay);
            $bussinesshours = explode(",",$bussinesshours);
            $hours = [];
            for ($i=0; $i < sizeof($bussinessDay); $i++) { 
                
                $hours = explode("-", $bussinesshours[$i]);
                
                BusinessHour::create([
                    'daysOfWeek'=> $dbdias[array_search($bussinessDay[$i],$dias)],//dias de la semana
                    'startTime'=> $hours[0],
                    'endTime'=> $hours[1],
                    'escenario_id' => $escenario->id,
                    ]);
            }
        }
        if($data1['paga']=='Si'){
            $data1['paga'] = 1;
            $days=explode(",", $request['pday']);
            $hora1=explode(",", $request["phour1"]);
            $hora2=explode(",", $request["phour2"]);
            $valor=explode(",", $request["prices"]);
            $colors=explode(",", $request["pcolor"]);
            if ($request['pday'] != null and $request["phour1"] != null 
            and $request["phour2"] != null and  $request["prices"] != null and 
            $request["pcolor"] != null){

                for ($i=0; $i < sizeof($days); $i++) { 
                  
                    price::create([
                        "dias" => $days[$i],
                        "color" => $colors[$i],
                        "startHour" => date("H:i:s",strtotime($hora1[$i])),
                        "endHour" => date("H:i:s",strtotime($hora2[$i])),
                        "hourPrice" => $valor[$i],
                        "escenario_id"=> $escenario->id,
                        ]);  
                    }
            }
            }else{
                $data1['paga'] = 0;
            $precios = $escenario->prices;
            foreach ($precios as $precio) {
                $precio->delete();
            }
        }
        
        $escenario->update($data1);
        return redirect()->route('escenarios.edit',$escenario->id)
            ->with('info', 'Escenario actualizado con exito');
    }

    public function destroy($id)
    {   
        $escenario = Escenario::findOrFail($id);
        $this->authorize('owner', $escenario);//eliminar solos los escenarios propios o de socios
        Storage::delete($escenario->img);//eliminar la imagen
         $escenario->delete();
        return redirect()->back()->with('info','eliminado con exito');
        // $cancha->delete();
        // return back()->with('info','eliminado con exito');
    }
    public function destroyBusinessHour(Request $request)
    {    
        if($request->ajax()){
            
             $DBH = BusinessHour::findOrFail($request['id']);
            // //$this->authorize('owner', $escenario);//eliminar solos los escenarios propios o de socios
            
            $DBH->delete();
            return response()->json(['
            success' => 'Record has been deleted successfully!',]);
        };
        // $cancha->delete();
        // return back()->with('info','eliminado con exito');
    }
    public function destroyPrice(Request $request)
    {    
        
        if($request->ajax()){
            $pri = price::findOrFail($request['id']);
            
           // //$this->authorize('owner', $escenario);//eliminar solos los escenarios propios o de socios
           
           $pri->delete();
           return response()->json(['
           success' => 'Record has been deleted successfully!']);
       };
        
        // $cancha->delete();
        // return back()->with('info','eliminado con exito');
    }
}
