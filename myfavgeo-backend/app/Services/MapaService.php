<?php

namespace App\Services;

use App\Models\Mapa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\DTOs\MapaDTO;
use App\DTOs\UpdateMapaDTO;
use Exception;

class MapaService{

    public function listarMapas(): Collection
    {
        return Mapa::withCount('pontos')->get();
    }

    public function buscarMapaPorId(int $id): Mapa{
        return Mapa::with('pontos')->findOrFail($id);
    }

    public function criarMapa(MapaDTO $dados): Mapa{
        return DB::transaction(function () use ($dados) {
            try{
                $mapa = Mapa::create($dados->toArray());

                Log::info("Mapa criado com sucesso: ID {$mapa->id}");
                return $mapa;
            }catch (Exception $e) {
                Log::error("Erro ao criar mapa: {$e->getMessage()}");
                throw $e;
            }
        });
    }

    public function atualizarMapa(int $id, UpdateMapaDTO $dados): ?Mapa{
        return DB::transaction(function () use ($id, $dados) {
            $mapa = $this->buscarMapaPorId($id);
            try{
                $mapa->update($dados->toArray());
                Log::info("Mapa atualizado com sucesso: ID {$mapa->id}");
                return $mapa;
            }catch (Exception $e) {
                Log::error("Erro ao atualizar mapa ID {$id}: {$e->getMessage()}");
                throw $e;
            }
        });
    }

    public function deletarMapa(int $id): bool{
        return DB::transaction(function () use ($id) {
            $mapa = $this->buscarMapaPorId($id);
            try{
                return $mapa->delete();
            }catch (Exception $e) {
                Log::error("Erro ao deletar mapa ID {$id}: {$e->getMessage()}");
                throw $e;
            }
        });
    }
}
