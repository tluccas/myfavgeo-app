<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mapa;
use App\Models\User;

class MapaFactory extends Factory
{
    protected $model = Mapa::class;

    public function definition(): array
    {
        return [
            'nome' => fake()->sentence(3),
            'descricao' => fake()->paragraph(),
            'url_imagem' => fake()->imageUrl(),
            'user_id' => User::factory(),
        ];
    }
}
