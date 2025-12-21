<?php

namespace App\DTOs;

readonly class PontoDTO
{
    public function __construct(
        public string $nome,
        public ?string $descricao,
        public ?string $url_imagem,
        public float $latitude,
        public float $longitude,
        public int $mapa_id,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            nome: $validated['nome'],
            descricao: $validated['descricao'] ?? null,
            url_imagem: $validated['url_imagem'] ?? null,
            latitude: $validated['latitude'],
            longitude: $validated['longitude'],
            mapa_id: $validated['mapa_id'],
        );
    }

    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'url_imagem' => $this->url_imagem,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'mapa_id' => $this->mapa_id,
        ];
    }
}
