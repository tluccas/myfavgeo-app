<?php

namespace Tests\Feature;

use App\Models\Mapa;
use App\Models\Ponto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PontoApiTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_usuario1_nao_pode_criar_ponto_em_mapa_de_usuario2()
    {
        // Criando dois usuários
        /** @var \App\Models\User $user1 */
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        // Criando um mapa para o usuário 2
        $mapaUsuario2 = Mapa::factory()->create([
            'user_id' => $user2->id,
        ]);

        $pontoUsuario1 = Ponto::factory()->make([
            'mapa_id' => $mapaUsuario2->id,
        ])->toArray();

        // Tentando criar um ponto no mapa do usuário 2 com o usuário 1 autenticado
        $response = $this->actingAs($user1, 'api')
                         ->postJson('/api/pontos', $pontoUsuario1);

        // Verificação
        $response->assertStatus(403); // Deve retornar "Forbidden"
    }
}
