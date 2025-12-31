<?php

namespace Database\Seeders;

use App\Models\Mapa;
use App\Models\Ponto;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuário inicial
        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'nome' => 'Recrutador NerdMonster',
                'password' => '123456', // Use uma senha segura em produção
            ]
            );

        // Mapa Exemplo
        $mapa = Mapa::create([
            'nome' => 'Pontos Turísticos SP',
            'descricao' => 'Lugares imperdíveis em São Paulo',
            'url_imagem' => 'https://images.unsplash.com/photo-1629984557780-4dde2292e245?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'user_id' => $user->id,
        ]);

        // Pontos de Exemplo
        Ponto::create([
            'nome' => 'MASP',
            'descricao' => 'Museu de Arte de São Paulo',
            'latitude' => -23.5614,
            'longitude' => -46.6563,
            'mapa_id' => $mapa->id,
        ]);

        Ponto::create([
            'nome' => 'Parque Ibirapuera',
            'descricao' => 'Área verde e lazer',
            'latitude' => -23.5874,
            'longitude' => -46.6576,
            'mapa_id' => $mapa->id,
        ]);
    }
}
