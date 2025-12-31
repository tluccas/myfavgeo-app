<?php

namespace App\Http\Controllers;

use App\DTOs\PontoDTO;
use App\Http\Requests\PontoStoreRequest;
use App\Http\Requests\PontoUpdateRequest;
use App\DTOs\UpdatePontoDTO;
use App\Services\PontoService;
use App\Models\Mapa;


class PontoController extends Controller
{
    private PontoService $pontoService;

    public function __construct(PontoService $pontoService)
    {
        $this->pontoService = $pontoService;
    }

    public function index()
    {
        $pontos = $this->pontoService->listarPontos();
        return $this->sendResponse($pontos, 'Pontos recuperados com sucesso.');
    }

    /**
     * @OA\Post(
     *   path="/api/pontos",
     *   summary="Criar novo ponto",
     *   tags={"Pontos"},
     *
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"nome", "latitude", "longitude", "mapa_id"},
     *       @OA\Property(property="nome", type="string", example="Praça Central"),
     *       @OA\Property(property="descricao", type="string", example="Ponto de encontro no centro da cidade", nullable=true),
     *       @OA\Property(property="url_imagem", type="string", example="https://exemplo.com/imagens/praca-central.jpg", nullable=true),
     *       @OA\Property(property="latitude", type="number", format="float", example=-23.55052),
     *       @OA\Property(property="longitude", type="number", format="float", example=-46.633308),
     *       @OA\Property(property="mapa_id", type="integer", example=6)
     *     )
     *   ),
     * 
     *   @OA\Response(
     *     response=201,
     *     description="Ponto criado com sucesso",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/ApiSuccess"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             ref="#/components/schemas/Ponto"
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
    public function store(PontoStoreRequest $request)
    {
        // Verifica se o mapa pertence ao usuário autenticado
        $mapa = Mapa::findOrFail($request->mapa_id);
        $this->authorize('update', $mapa);

        $dto = PontoDTO::fromRequest($request->validated());
        $ponto = $this->pontoService->criarPonto($dto);

        if(!$ponto){
            return $this->sendError('Erro ao criar o ponto.', [], 500);
        }
        return $this->sendResponse($ponto, 'Ponto criado com sucesso.', 201);
    }

    /**
     * @OA\Get(
     *   path="/api/pontos/{id}",
     *   summary="Recuperar o ponto por ID",
     *   tags={"Pontos"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="ID do ponto",
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Ponto recuperado com sucesso",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/ApiSuccess"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             ref="#/components/schemas/PontoID"
     *           )
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Ponto não encontrado",
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
        $ponto = $this->pontoService->buscarPontoPorId((int)$id);
        if(!$ponto){
            return $this->sendError('Ponto não encontrado.', [], 404);
        }
        return $this->sendResponse($ponto, 'Ponto recuperado com sucesso.');
    }

    public function update(string $id, PontoUpdateRequest $request)
    {
        $dto = UpdatePontoDTO::fromRequest($request->validated());
        $ponto = $this->pontoService->atualizarPonto((int)$id, $dto);

        if(!$ponto){
            return $this->sendError('Erro ao atualizar o ponto.', [], 500);
        }
        return $this->sendResponse($ponto, 'Ponto atualizado com sucesso.');
    }

    /**
     * @OA\Delete(
     *   path="/api/pontos/{id}",
     *   summary="Deletar ponto",
     *   tags={"Pontos"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     description="ID do ponto",
     *     @OA\Schema(
     *       type="integer"
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Ponto deletado com sucesso",
     *     @OA\JsonContent(
     *       allOf={
     *         @OA\Schema(ref="#/components/schemas/ApiSuccess"),
     *         @OA\Schema(
     *           @OA\Property(
     *             property="data",
     *             type="array",
     *             @OA\Items(),
     *             example={}
     *           )
     *         )
     *       }
     *     )
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="Ponto não encontrado",
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
    public function destroy(string $id)
    {
        $deleted = $this->pontoService->deletarPonto((int)$id);
        if(!$deleted){
            return $this->sendError('Erro ao deletar o ponto.', [], 500);
        }
        return $this->sendResponse([], 'Ponto deletado com sucesso.');
    }

}