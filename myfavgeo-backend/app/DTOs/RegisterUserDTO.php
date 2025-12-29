<?php

namespace App\DTOs;

readonly class RegisterUserDTO
{
    public function __construct(
        public string $nome,
        public string $email,
        public string $password,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            nome: $validated['nome'],
            email: $validated['email'],
            password: $validated['password'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->nome,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}