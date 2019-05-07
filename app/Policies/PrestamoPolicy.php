<?php

namespace App\Policies;

use App\User;
use App\Prestamo;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrestamoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the prestamo.
     *
     * @param  \App\User  $user
     * @param  \App\Prestamo  $prestamo
     * @return mixed
     */
    public function view(User $user, Prestamo $prestamo)
    {   
        return ($user->id === $prestamo->user_id);
    }

    // /**
    //  * Determine whether the user can create prestamos.
    //  *
    //  * @param  \App\User  $user
    //  * @return mixed
    //  */
    // public function create(User $user)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can update the prestamo.
    //  *
    //  * @param  \App\User  $user
    //  * @param  \App\Prestamo  $prestamo
    //  * @return mixed
    //  */
    // public function update(User $user, Prestamo $prestamo)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can delete the prestamo.
    //  *
    //  * @param  \App\User  $user
    //  * @param  \App\Prestamo  $prestamo
    //  * @return mixed
    //  */
    // public function delete(User $user, Prestamo $prestamo)
    // {
    //     //
    // }
}
