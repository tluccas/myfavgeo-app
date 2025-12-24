<?php

namespace App\Services;

use App\DTOs\PontoDTO;
use App\Models\Ponto;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\DTOs\UpdatePontoDTO;

use Exception;

class PontoService{

    public function listarPontos(): Collection
    {
        return Ponto::with('mapa')->get();
    }

    public function buscarPontoPorId(int $id): Ponto{
        return Ponto::with('mapa')->findOrFail($id);
    }

    public function criarPonto(PontoDTO $dados): Ponto{
        return DB::transaction(function () use ($dados){
            try{
                $ponto = Ponto::create($dados->toArray());

                Log::info("Ponto criado com sucesso: ID {$ponto->id}");
                return $ponto;
            }catch (Exception $e) {
                Log::error("Erro ao criar ponto: {$e->getMessage()}");
                throw $e;
            }
        });
    }

    public function atualizarPonto(int $id, UpdatePontoDTO $dados): ?Ponto{
        return DB::transaction(function () use ($id, $dados) {
            $ponto = $this->buscarPontoPorId($id);
            try{
                $ponto->update($dados->toArray());
                Log::info("Ponto atualizado com sucesso: ID {$ponto->id}");
                return $ponto;
            }catch (Exception $e) {
                Log::error("Erro ao atualizar ponto ID {$id}: {$e->getMessage()}");
                throw $e;
            }
        });
    }

    public function deletarPonto(int $id): bool{
        return DB::transaction(function () use ($id) {
            $ponto = $this->buscarPontoPorId($id);
            try{
                return $ponto->delete();
            }catch (Exception $e) {
                Log::error("Erro ao deletar ponto ID {$id}: {$e->getMessage()}");
                throw $e;
            }
        });
    }

}
