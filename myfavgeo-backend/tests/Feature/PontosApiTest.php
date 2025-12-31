<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Mapa;
use App\Models\Ponto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PontosApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se o dono do mapa consegue adicionar um ponto com sucesso.
     */
    public function test_dono_do_mapa_pode_adicionar_ponto()
    {
        // Criando usuário e mapa dele
        /** @var \App\Models\User $user */
        $user = User::factory()->createOne();
        
        /** @var \App\Models\Mapa $mapa */
        $mapa = Mapa::factory()->createOne(['user_id' => $user->id]);

        $dadosPonto = [
            'nome' => 'Ponto Turístico',
            'latitude' => -23.5505,
            'longitude' => -46.6333,
            'mapa_id' => $mapa->id,
        ];

        // Tentando criar o ponto autenticado como dono
        $response = $this->actingAs($user, 'api')
                         ->postJson('/api/pontos', $dadosPonto);

        // Verifica sucesso
        $response->assertStatus(201)
                 ->assertJsonFragment(['nome' => 'Ponto Turístico']);

        $this->assertDatabaseHas('pontos', [
            'nome' => 'Ponto Turístico',
            'mapa_id' => $mapa->id
        ]);
    }

    /**
     * TESTE DE SEGURANÇA:
     * Garante que um usuário não pode adicionar pontos no mapa de outro.
     */
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
