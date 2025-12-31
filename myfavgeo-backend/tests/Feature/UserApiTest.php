<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_apenas_uma_conta_por_email()
    {
        $payload = [
            'nome' => 'User Teste',
            'email' => 'testeapi@teste.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Usuário 1: deve criar com sucesso
        $response = $this->postJson('/api/register', $payload);
        $response->assertStatus(201);

        // Usuário 2 com mesmo email: deve falhar
        $response2 = $this->postJson('/api/register', $payload);
        $response2->assertStatus(422); // Deve retornar erro de validação "Unprocessable Content"
        $response2->assertJsonValidationErrors(['email']); // "O email já está em uso."
    }
}
