<?php

namespace App\Http\Controllers;

use App\DTOs\RegisterUserDTO;
use App\Http\Requests\RegisterUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{   
    public function __construct(protected UserService $userService) {}

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciais inválidas'
            ], 401);
        }

        return response()
            ->json(['message' => 'Login realizado com sucesso'])
            ->cookie(
                'token',      // nome do cookie
                $token,       // valor (JWT)
                60,           // minutos (mudar depois?)
                '/',          // path
                null,         // dominio
                false,        // HTTPS
                true,         // httpOnly
                false,        // raw
                'lax'         // sameSite
            );
    }

    public function register(RegisterUserRequest $request)
    {
        $dto = RegisterUserDTO::fromRequest($request->validated());
        $user = $this->userService->register($dto);

        $token = Auth::guard('api')->login($user);

        return $this->sendResponse($user, 'Usuário registrado com sucesso.', 201)
            ->cookie(
                'token',      // nome do cookie
                $token,       // valor (JWT)
                60,           // minutos (mudar depois?)
                '/',          // path
                null,         // dominio
                false,        // HTTPS 
                true,         // httpOnly
                false,        // raw
                'lax'         // sameSite
            );

    }

    public function me()
    {
        return response()->json(Auth::guard('api')->user());
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()
            ->json(['message' => 'Logout realizado'])
            ->cookie('token', '', -1, '/', null, true, true);
    }
}
