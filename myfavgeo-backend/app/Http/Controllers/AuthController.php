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

    /**
     * @OA\Post(
     *   path="/api/login",
     *   summary="Login de usuário",
     *   tags={"Auth"},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"email", "password"},
     *       @OA\Property(property="email", type="string", format="email", example="teste@teste.com"),
     *       @OA\Property(property="password", type="string", format="password", example="123456")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Login realizado com sucesso",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="message", type="string", example="Login realizado com sucesso")
     *     )
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Credenciais inválidas",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="message", type="string", example="Credenciais inválidas")
     *     )
     *   )
     * )
     */
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

    /**
     * @OA\Post(
     *   path="/api/register",
     *   summary="Registrar novo usuário",
     *   tags={"Auth"},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"nome", "email", "password", "password_confirmation"},
     *       @OA\Property(property="nome", type="string", example="Apenas Testando"),
     *       @OA\Property(property="email", type="string", format="email", example="apenasTestando@teste.com"),
     *       @OA\Property(property="password", type="string", format="password", example="123456"),
     *       @OA\Property(property="password_confirmation", type="string", format="password", example="123456")
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Usuário registrado com sucesso",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/ApiSuccess"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             ref="#/components/schemas/User"
     *           )
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response=422,
     *     description="Erro de validação",
     *     @OA\JsonContent(ref="#/components/schemas/ApiError")
     *   )
     * )
     */
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

    /**
     * @OA\Get(
     *   path="/api/me",
     *   summary="Obter dados do usuário autenticado",
     *   tags={"Auth"},
     *   @OA\Response(
     *     response=200,
     *     description="Dados do usuário",
     *     @OA\JsonContent(ref="#/components/schemas/User")
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Não autorizado",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Unauthenticated."
     *       )
     *     )
     *   )
     * )
     */
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
