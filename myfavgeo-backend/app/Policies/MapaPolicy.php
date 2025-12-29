<?php

namespace App\Policies;

use App\Models\Mapa;
use App\Models\User;

class MapaPolicy
{

    public function view(User $user, Mapa $mapa): bool
    {
        return $mapa ->user_id === $user->id;
    }

    public function update(User $user, Mapa $mapa): bool
    {
        return $mapa->user_id === $user->id;
    }

    public function delete(User $user, Mapa $mapa): bool
    {
        return $mapa->user_id === $user->id;
    }

}
