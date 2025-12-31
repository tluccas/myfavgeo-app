<?php

namespace App\Http\Controllers;

use App\DTOs\MapaDTO;
use App\DTOs\UpdateMapaDTO;
use App\Http\Requests\RequestStoreMapa;
use App\Http\Requests\UpdateMapaRequest;
use App\Services\MapaService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MapaController extends Controller
{
    public function __construct(protected MapaService $mapaService) {}

    /**
     * @OA\Get(
     *   path="/api/mapas",
     *   summary="Listar todos os mapas",
     *   tags={"Mapas"},
     *
     *   @OA\Response(
     *     response=200,
     *     description="Lista de mapas recuperada com sucesso",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/ApiSuccess"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Mapa")
     *           )
     *         )
     *       }
     *     )
     *   ),
     *
     *   @OA\Response(
     *     response=401,
     *     description="Não autorizado",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Não Autenticado."
     *       )
     *     )
     *   )
     * )
     */
    public function index()
    {
        if (!Auth::check()) {
            return $this->sendError('Não autorizado.', [], 401);
        }

        $mapa = $this->mapaService->listarMapas(Auth::id());
        return $this->sendResponse($mapa, 'Mapas recuperados com sucesso.');
    }

    /**
     * @OA\Post(
     *   path="/api/mapas",
     *   summary="Criar novo mapa",
     *   tags={"Mapas"},
     *
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"nome"},
     *       @OA\Property(property="nome", type="string", example="Mapa de Restaurantes Italianos"),
     *       @OA\Property(property="descricao", type="string", example="Melhores restaurantes da cidade", nullable=true),
     *       @OA\Property(property="url_imagem", type="string", example="https://meusite.com/imagem.png", nullable=true),
     *     )
     *   ),
     * 
     *   @OA\Response(
     *     response=201,
     *     description="Mapa criado com sucesso",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/ApiSuccess"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nome", type="string", example="Mapa de Restaurantes Italianos"),
     *             @OA\Property(property="descricao", type="string", example="Melhores restaurantes da cidade"),
     *             @OA\Property(property="url_imagem", type="string", example="https://meusite.com/imagem.png"),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *           )
     *         )
     *       }
     *     )
     *   ),
     *
     *   @OA\Response(
     *     response=422,
     *     description="Erro de validação",
     *     @OA\JsonContent(ref="#/components/schemas/ApiError")
     *   ),
     * 
     *     @OA\Response(
     *     response=401,
     *     description="Não autorizado",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Não Autenticado."
     *       )
     *     )
     *   )
     * )
     */
    public function store(RequestStoreMapa $request)
    {
        $dto = MapaDTO::fromRequest($request->validated());
        $mapa = $this->mapaService->criarMapa($dto, Auth::id());

        if (!$mapa) {
            return $this->sendError('Erro ao criar o mapa.', [], 500);
        }

        return $this->sendResponse($mapa, 'Mapa criado com sucesso.', 201);
    }

    /**
     * @OA\Get(
     *   path="/api/mapas/{id}",
     *   summary="Recuperar o mapa por ID",
     *   tags={"Mapas"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="ID do mapa",
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Mapa recuperado com sucesso",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/MapaID"),
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Mapa não encontrado",
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Não autorizado",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Não Autenticado."
     *       )
     *     )
     *   )
     * )
     */
    public function show(string $id)
    {
        $mapa = $this->mapaService->buscarMapaPorId((int) $id);

        if (!$mapa) {
            return $this->sendError('Mapa não encontrado.', [], 404);
        }

        $this->authorize('view', $mapa);

        return $this->sendResponse($mapa, 'Mapa recuperado com sucesso.');
    }


    /**
     * @OA\Put(
     *   path="/api/mapas/{id}",
     *   summary="Editar mapa existente",
     *   tags={"Mapas"},
     *
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="ID do mapa",
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     * 
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="nome", type="string", example="Mapa de Restaurantes Italianos"),
     *       @OA\Property(property="descricao", type="string", example="Melhores restaurantes da cidade", nullable=true),
     *       @OA\Property(property="url_imagem", type="string", example="https://meusite.com/imagem.png", nullable=true),
     *     )
     *   ),
     * 
     *   @OA\Response(
     *     response=200,
     *     description="Mapa atualizado com sucesso",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/ApiSuccess"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             type="object",
     *             @OA\Property(ref="#/components/schemas/MapaID"),
     *           )
     *         )
     *       }
     *     )
     *   ),
     *
     *   @OA\Response(
     *     response=422,
     *     description="Erro de validação",
     *     @OA\JsonContent(ref="#/components/schemas/ApiError")
     *   ),
     * 
     *     @OA\Response(
     *     response=401,
     *     description="Não autorizado",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Não Autenticado."
     *       )
     *     )
     *   )
     * )
     */
    public function update(UpdateMapaRequest $request, string $id)
    {
        $mapa = $this->mapaService->buscarMapaPorId((int) $id);

        if (!$mapa) {
            return $this->sendError('Mapa não encontrado.', [], 404);
        }

        $this->authorize('update', $mapa);

        $dto = UpdateMapaDTO::fromRequest($request->validated());

        $mapa = $this->mapaService->atualizarMapa($mapa, $dto);

        return $this->sendResponse($mapa, 'Mapa atualizado com sucesso.');
    }


    /**
     * @OA\Delete(
     *   path="/api/mapas/{id}",
     *   summary="Deletar mapa",
     *   tags={"Mapas"},
     *
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="ID do mapa",
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     * 
     * 
     *   @OA\Response(
     *     response=201,
     *     description="Mapa deletado com sucesso",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/ApiSuccess"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             type="boolean",
     *             example=null,
     *           )
     *         )
     *       }
     *     )
     *   ),
     *
     * 
     *     @OA\Response(
     *     response=401,
     *     description="Não autorizado",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Não Autenticado."
     *       )
     *     )
     *   )
     * )
     */
    public function destroy(string $id)
    {
        $mapa = $this->mapaService->buscarMapaPorId((int) $id);

        if (!$mapa) {
            return $this->sendError('Mapa não encontrado.', [], 404);
        }

        $this->authorize('delete', $mapa);

        $this->mapaService->deletarMapa($mapa);

        return $this->sendResponse(null, 'Mapa deletado com sucesso.');
    }
}
