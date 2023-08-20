<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    //O user que está sendo passado aqui é o usuário autenticado.
    public function isAdmin(User $user)
    {
        return $user->isAdmin; //Se for admin o retorno é true.
    }
}
