<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class MapaResource extends JsonResource{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'url_imagem' => $this->url_imagem,
            'resumo' => $this->getResumo(),
            'pontos' => PontoResource::collection($this->whenLoaded('pontos')),
        ];
    }
}
