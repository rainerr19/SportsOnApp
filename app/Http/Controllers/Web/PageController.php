<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use \App\Escenario;
use \App\User;
use \App\Interest;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use \App\Classes\HoraTablaCreator;
use Illuminate\Support\Facades\Storage;

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
    public function perfil()
    {  //perfil
        //$this->authorize('ownPerfil', $user);
        $user = User::findOrFail(auth()->id());
        $interests = Interest::paginate();
        //$id = $user->$id;
        return view('web.perfil', compact('user','interests'));
    }
    public function updatePerfil(Request $request, User $user)
    {  //perfil
        $user = User::findOrFail(auth()->id());
        if ($request->hasFile('imagen')) {
            //dd($user->img);
            Storage::delete($user->img);
            $user->img = $request->file('imagen')->store('public/UserImg');
            $user->save();
        }
        //$role->permissions()->sync($request->get('permissions'));
        //  dd( $request);
        if ($request->sexo == 'Vacio'){
            $user->update($request->except(['sexo','preferencias']));
            $user->interests()->sync($request->get('preferencias'));
        }else{

            $user->interests()->sync($request->get('preferencias'));
            $user->update($request->except(['preferencias']));
        }
        // $user = (new User)->fill($data);
        // //$escenario = Escenario::create($data);
        // //******* IMAGEN */
        // $user->img = $request->file('imagen')->store('public/UserImg');
        // $user->save();
        return redirect()->route('web.perfil')
            ->with('info', 'perfil guardado con éxito');
    }
    public function destroy()
    {
        $user = User::findOrFail(auth()->id());
        $user->delete();
    
        return redirect()->route('SportsOn')->with('info','eliminado con exito');
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
