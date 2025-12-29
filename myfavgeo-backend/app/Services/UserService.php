<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\DTOs\RegisterUserDTO;
use Exception;

class UserService
{
    public function register(RegisterUserDTO $dto): User
    {
        try {
            return DB::transaction(function () use ($dto) {
                $user = User::create($dto->toArray());


                return $user;
            });
        } catch (Exception $e) {
            Log::error('Registro de usuário falhou: ' . $e->getMessage());
            throw $e;
        }
    }


}
