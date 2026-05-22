<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    // ¿Quién puede ver la lista de usuarios/cuentas?
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    // ¿Quién puede crear nuevas cuentas?
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    // ¿Quién puede editar cuentas?
    public function update(User $user): bool
    {
        return $user->isAdmin();
    }
}
