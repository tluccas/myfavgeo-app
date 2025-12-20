<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class PontoResource extends JsonResource{

    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'coordenadas_formatadas' => $this->getCoordenadasFormatadas(),
            'resumo' => $this->getResumo(),
        ];
    }
}
