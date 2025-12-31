<?php

namespace Tests\Feature;

use App\Models\Mapa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase; 

class MapasApiTest extends TestCase
{
    // Resetando o banco a cada teste
    use RefreshDatabase;

    /**
     * Testando se é possível criar um mapa estando autenticado.
     */
    public function test_usuario_autenticado_pode_criar_mapa()
    {
        // Criando um usuário de teste autenticado
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        
        $dadosMapa = [
            'nome' => 'Mapa de Teste',
            'descricao' => 'Descrição do mapa de teste',
        ];

        // Simulando usuário logado via API (JWT)
        $response = $this->actingAs($user, 'api')
                         ->postJson('/api/mapas', $dadosMapa);

        // Verificação
        $response->assertStatus(201) // Deve ser criado com sucesso
                 ->assertJsonFragment(['nome' => 'Mapa de Teste']); // Verifica se o JSON retornado tem o nome

        // Verificando se salvou no banco
        $this->assertDatabaseHas('mapas', [
            'nome' => 'Mapa de Teste',
            'user_id' => $user->id
        ]);
    }

    /**
     * Testando se o sistema bloqueia usuário não logado.
     */
    public function test_usuario_nao_autenticado_nao_pode_criar_mapa()
    {
        $dadosMapa = [
            'nome' => 'Mapa Invasor',
            'descricao' => 'Tentando criar sem login',
        ];

        // Tentando postar sem estar autenticado
        $response = $this->postJson('/api/mapas', $dadosMapa);

        $response->assertStatus(401); // Deve retornar "Unauthorized"
    }

    /**
     * Testando validação de campos obrigatórios.
     */
    public function test_nao_pode_criar_mapa_sem_nome()
    {
        // Usuário autenticado
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')
                         ->postJson('/api/mapas', [
            'descricao' => 'Sem nome',
        ]);

        $response->assertStatus(422); // Deve retornar erro de validação
        $response->assertJsonValidationErrors(['nome']);
    }

    /**
    * Testando se um usuário consegue acessar o mapa de outro usuário.
    */
    public function test_usuario1_nao_pode_ver_mapa_de_usuario2()
    {
        // Criando os dois usuários
        /** @var \App\Models\User $user1 */
        $user1 = User::factory()->create();
        /** @var \App\Models\User $user2 */
        $user2 = User::factory()->create();

        // Criando um mapa para o user1
        $mapaUser1 = Mapa::factory()->create([
            'user_id' => $user1->id,
        ]);
        
        // Tentando acessar o mapa do user1 com o user2
        $response = $this->actingAs($user2, 'api')
                            ->getJson("/api/mapas/{$mapaUser1->id}");

        $response->assertStatus(403); // Deve retornar "Forbidden"
    }
    
    
}
