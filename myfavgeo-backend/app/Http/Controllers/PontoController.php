<?php

namespace App\Http\Controllers;

use App\DTOs\PontoDTO;
use App\Http\Requests\PontoStoreRequest;
use App\Http\Requests\PontoUpdateRequest;
use App\DTOs\UpdatePontoDTO;
use App\Services\PontoService;


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

    public function store(PontoStoreRequest $request)
    {
        $dto = PontoDTO::fromRequest($request->validated());
        $ponto = $this->pontoService->criarPonto($dto);

        if(!$ponto){
            return $this->sendError('Erro ao criar o ponto.', [], 500);
        }
        return $this->sendResponse($ponto, 'Ponto criado com sucesso.', 201);
    }

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

    public function destroy(string $id)
    {
        $deleted = $this->pontoService->deletarPonto((int)$id);
        if(!$deleted){
            return $this->sendError('Erro ao deletar o ponto.', [], 500);
        }
        return $this->sendResponse([], 'Ponto deletado com sucesso.');
    }

}