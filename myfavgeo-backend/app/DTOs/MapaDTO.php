<?php

namespace App\DTOs;

readonly class MapaDTO
{
    public function __construct(
        public string $nome,
        public ?string $descricao,
        public ?string $url_imagem,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            nome: $validated['nome'],
            descricao: $validated['descricao'] ?? null,
            url_imagem: $validated['url_imagem'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'url_imagem' => $this->url_imagem,
        ];
    }
}
