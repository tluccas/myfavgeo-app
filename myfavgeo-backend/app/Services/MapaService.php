<?php

namespace App\Services;

use App\Models\Mapa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\DTOs\MapaDTO;
use App\DTOs\UpdateMapaDTO;
use Illuminate\Support\Facades\Auth;
use Exception;

class MapaService{

    public function listarMapas(): Collection
    {
        return Mapa::doUsuario(Auth::guard('api')->id())
            ->withCount('pontos')
            ->get();
    }

    public function buscarMapaPorId(int $id): Mapa
    {
        return Mapa::doUsuario(Auth::guard('api')->id())
            ->with('pontos')
            ->findOrFail($id);
    }

    public function criarMapa(MapaDTO $dados): Mapa
    {
        try {
            return DB::transaction(function () use ($dados) {
                $mapa = Mapa::create(array_merge(
                    $dados->toArray(),
                    ['user_id' => Auth::guard('api')->id()]
                ));

                Log::info("Mapa criado com sucesso: ID {$mapa->id}");

                return $mapa;
            });
        } catch (Exception $e) {
            Log::error("Erro ao criar mapa: {$e->getMessage()}");
            throw $e;
        }
    }

    public function atualizarMapa(int $id, UpdateMapaDTO $dados): Mapa
    {
        return DB::transaction(function () use ($id, $dados) {
            $mapa = $this->buscarMapaPorId($id);

            try {
                $mapa->update($dados->toArray());

                Log::info("Mapa atualizado", [
                    'mapa_id' => $mapa->id,
                    'user_id' => Auth::guard('api')->id(),
                ]);

                return $mapa;
            } catch (Exception $e) {
                Log::error("Erro ao atualizar mapa ID {$id}: {$e->getMessage()}");
                throw $e;
            }
        });
    }

    public function deletarMapa(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $mapa = $this->buscarMapaPorId($id);

            try {
                return $mapa->delete();
            } catch (Exception $e) {
                Log::error("Erro ao deletar mapa ID {$id}: {$e->getMessage()}");
                throw $e;
            }
        });
    }
}
