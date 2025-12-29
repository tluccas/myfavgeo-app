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

    public function listarMapas(int $userId): Collection
    {
        return Mapa::doUsuario($userId)
            ->withCount('pontos')
            ->get();
    }

    public function buscarMapaPorId(int $id, int $userId): Mapa
    {
        return Mapa::doUsuario($userId)
            ->with('pontos')
            ->findOrFail($id);
    }

    public function criarMapa(MapaDTO $dados, int $userId): Mapa
    {
        try {
            return DB::transaction(function () use ($dados, $userId) {
                $mapa = Mapa::create(array_merge(
                    $dados->toArray(),
                    ['user_id' => $userId]
                ));

                Log::info("Mapa criado com sucesso: ID {$mapa->id}");

                return $mapa;
            });
        } catch (Exception $e) {
            Log::error("Erro ao criar mapa: {$e->getMessage()}");
            throw $e;
        }
    }

    public function atualizarMapa(int $id, UpdateMapaDTO $dados, int $userId): Mapa
    {
        return DB::transaction(function () use ($id, $dados, $userId) {
            $mapa = $this->buscarMapaPorId($id, $userId);

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

    public function deletarMapa(int $id, int $userId): bool
    {
        return DB::transaction(function () use ($id, $userId) {
            $mapa = $this->buscarMapaPorId($id, $userId);

            try {
                return $mapa->delete();
            } catch (Exception $e) {
                Log::error("Erro ao deletar mapa ID {$id}: {$e->getMessage()}");
                throw $e;
            }
        });
    }
}
