<?php

namespace Database\Factories;

use App\Models\Mapa;
use App\Models\Ponto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ponto>
 */
class PontoFactory extends Factory
{
    protected $model = Ponto::class;
     
    public function definition(): array
    {
        return [
            'nome' => fake()->sentence(3),
            'descricao' => fake()->paragraph(),
            'latitude' => fake()->randomFloat(10, -10000, 10000),
            'longitude' => fake()->randomFloat(10, -10000, 10000),
            'mapa_id' => Mapa::factory(),

        ];
    }
}
