<?php

namespace App\Http\Controllers;

use App\DTOs\MapaDTO;
use App\DTOs\UpdateMapaDTO;
use App\Http\Requests\RequestStoreMapa;
use App\Http\Requests\UpdateMapaRequest;
use App\Services\MapaService;

class MapaController extends Controller
{
    public function __construct(protected MapaService $mapaService) {}

    /**
    * @OA\Get(
    *     path="/api/mapas",
    *     summary="Listar todos os mapas",
    *     tags={"Mapas"},
    *     @OA\Response(
    *         response=200,
    *         description="Lista de mapas recuperada com sucesso",
    *         @OA\JsonContent(
    *             allOf={
    *                 @OA\Schema(ref="#/components/schemas/ApiSuccess"),
    *                 @OA\Schema(
    *                     @OA\Property(
    *                         property="data",
    *                         type="array",
    *                         @OA\Items(ref="#/components/schemas/Mapa")
    *                     )
    *                 )
    *             }
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *
    * )
    */
    public function index()
    {
        $mapa = $this->mapaService->listarMapas();
        return $this->sendResponse($mapa, 'Mapas recuperados com sucesso.');
    }

    public function store(RequestStoreMapa $request)
    {
        $dto = MapaDTO::fromRequest($request->validated());
        $mapa = $this->mapaService->criarMapa($dto);

        if (!$mapa) {
            return $this->sendError('Erro ao criar o mapa.', [], 500);
        }

        return $this->sendResponse($mapa, 'Mapa criado com sucesso.', 201);
    }

    public function show(string $id)
    {
        $mapa = $this->mapaService->buscarMapaPorId((int)$id);
        if (!$mapa) {
            return $this->sendError('Mapa não encontrado.', [], 404);
        }
        return $this->sendResponse($mapa, 'Mapa recuperado com sucesso.');
    }

    public function update(UpdateMapaRequest $request, string $id)
    {
        $dto = UpdateMapaDTO::fromRequest($request->validated());
        $mapa = $this->mapaService->atualizarMapa((int)$id, $dto);

        if (!$mapa) {
            return $this->sendError('Erro ao atualizar o mapa.', [], 500);
        }

        return $this->sendResponse($mapa, 'Mapa atualizado com sucesso.');
    }

    public function destroy(string $id)
    {
        $deletado = $this->mapaService->deletarMapa((int)$id);

        if (!$deletado) {
            return $this->sendError('Erro ao deletar o mapa.', [], 500);
        }

        return $this->sendResponse(null, 'Mapa deletado com sucesso.');
    }

}
