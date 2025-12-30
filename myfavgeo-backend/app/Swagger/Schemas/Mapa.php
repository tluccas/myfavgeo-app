<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *   schema="Mapa",
 *   type="object",
 *
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="nome", type="string", example="Mapa de Restaurantes Italianos"),
 *   @OA\Property(
 *     property="descricao",
 *     type="string",
 *     example="Melhores restaurantes de comida Italiana na cidade de São Paulo",
 *     nullable=true
 *   ),
 *   @OA\Property(
 *     property="url_imagem",
 *     type="string",
 *     example="https://meusite.com/imagens/mapa1.png",
 *     nullable=true
 *   ),
 *   @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-15T10:00:00Z"),
 *   @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-20T15:30:00Z"),
 *   @OA\Property(property="user_id", type="integer", example=4),
 *   @OA\Property(property="pontos_count", type="integer", example=12)
 * 
 * )
 * 
 * @OA\Schema(
 *   schema="MapaID",
 *  type="object",
 * 
 * *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="nome", type="string", example="Mapa de Restaurantes Italianos"),
 *   @OA\Property(
 *     property="descricao",
 *     type="string",
 *     example="Melhores restaurantes de comida Italiana na cidade de São Paulo",
 *     nullable=true
 *   ),
 *   @OA\Property(
 *     property="url_imagem",
 *     type="string",
 *     example="https://meusite.com/imagens/mapa1.png",
 *     nullable=true
 *   ),
 *   @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-15T10:00:00Z"),
 *   @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-20T15:30:00Z"),
 *   @OA\Property(property="user_id", type="integer", example=4),
 * *   @OA\Property(
 *     property="pontos",
 *     type="array",
 *    @OA\Items(ref="#/components/schemas/Ponto")
 *   )
 * )
 * 
 */
class Mapa {}