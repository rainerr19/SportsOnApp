<?php

namespace App\Policies;

use App\User;
use App\Escenario;
use App\Asociado;
use Spatie\Permission\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class EscenarioPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function owner(User $user,Escenario $escenario )
    {
        $permiso = FALSE;
        if ($user->isAsociado()) {
            //$asociadosAble = Asociado::all()->where('escenario_id',$escenario->id);
            $escenarioAble = Escenario::all()->whereIn('id', Asociado::all()->where('user_asociado',$user->id)->pluck('escenario_id'));
            $permiso = $escenarioAble->where('id',$escenario->id)->isNotEmpty();//vacio es que no tiene permiso osea falso
        }
        return ($user->id == $escenario->user_id) or ($permiso) or ((($user->hasAllRoles('super-admin'))  or ($user->hasAllRoles('admin'))));
    }
    // public function createLimite(User $user,Escenario $escenario )
    // {
    //     #code
    //      #vista---> @can('createLimite', $escenarios) @endcan
    // }
}
