<?php

namespace App\Services;

use App\Models\Mapa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\DTOs\MapaDTO;
use App\DTOs\UpdateMapaDTO;


class MapaService
{
    public function listarMapas(): Collection
    {
        return Mapa::withCount('pontos')->get();
    }

    public function buscarMapaPorId(int $id): Mapa
    {
        return Mapa::with('pontos')->findOrFail($id);
    }

    public function criarMapa(MapaDTO $dados, int $userId): Mapa
    {
        return DB::transaction(function () use ($dados, $userId) {
            return Mapa::create([
                ...$dados->toArray(),
                'user_id' => $userId
            ]);
        });
    }

    public function atualizarMapa(Mapa $mapa, UpdateMapaDTO $dados): Mapa
    {
        $mapa->update($dados->toArray());
        return $mapa;
    }

    public function deletarMapa(Mapa $mapa): bool
    {
        return $mapa->delete();
    }
}
