<?php

namespace App\Http\Controllers;

use App\DTOs\MapaDTO;
use App\DTOs\UpdateMapaDTO;
use App\Http\Requests\RequestStoreMapa;
use App\Http\Requests\UpdateMapaRequest;
use App\Services\MapaService;
use Illuminate\Http\Request;

class MapaController extends Controller
{
    public function __construct(protected MapaService $mapaService) {}

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

    // ✅ Adicione estes métodos
    protected function sendResponse($data, $message, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function sendError($message, $errors = [], $code = 404)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
