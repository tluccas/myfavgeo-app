<?php

namespace App\DTOs;

readonly class UpdateMapaDTO
{
    public function __construct(
        public ?string $nome,
        public ?string $descricao,
        public ?string $url_imagem,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            nome: $validated['nome'] ?? null,
            descricao: $validated['descricao'] ?? null,
            url_imagem: $validated['url_imagem'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'url_imagem' => $this->url_imagem,
        ], fn($value) => !is_null($value));
    }
}
