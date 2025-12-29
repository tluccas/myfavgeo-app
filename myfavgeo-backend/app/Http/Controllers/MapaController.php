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

    public function index()
    {

        $mapa = $this->mapaService->listarMapas(Auth::id());
        return $this->sendResponse($mapa, 'Mapas recuperados com sucesso.');
    }

    public function store(RequestStoreMapa $request)
    {
        $dto = MapaDTO::fromRequest($request->validated());
        $mapa = $this->mapaService->criarMapa($dto, Auth::id());

        if (!$mapa) {
            return $this->sendError('Erro ao criar o mapa.', [], 500);
        }

        return $this->sendResponse($mapa, 'Mapa criado com sucesso.', 201);
    }

    public function show(string $id)
    {
        $mapa = $this->mapaService->buscarMapaPorId((int) $id);

        $this->authorize('view', $mapa);

        return $this->sendResponse($mapa, 'Mapa recuperado com sucesso.');
    }

    public function update(UpdateMapaRequest $request, string $id)
    {
        $mapa = $this->mapaService->buscarMapaPorId((int) $id);

        $this->authorize('update', $mapa);

        $dto = UpdateMapaDTO::fromRequest($request->validated());

        $mapa = $this->mapaService->atualizarMapa($mapa, $dto);

        return $this->sendResponse($mapa, 'Mapa atualizado com sucesso.');
    }

    public function destroy(string $id)
    {
        $mapa = $this->mapaService->buscarMapaPorId((int) $id);

        $this->authorize('delete', $mapa);

        $this->mapaService->deletarMapa($mapa);

        return $this->sendResponse(null, 'Mapa deletado com sucesso.');
    }
}
