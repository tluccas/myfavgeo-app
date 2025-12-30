<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *   schema="Ponto",
 *   type="object",
 *
 *   @OA\Property(property="id", type="integer", example=2),
 *   @OA\Property(property="nome", type="string", example="Restaurante Bella Italia"),
 *   @OA\Property(
 *     property="descricao",
 *     type="string",
 *     example="Restaurante italiano famoso por suas massas artesanais",
 *     nullable=true
 *   ),
 *  @OA\Property(property="latitude", type="number", format="float", example=-23.55052),
 *  @OA\Property(property="longitude", type="number", format="float", example=-46.633308),
 *  @OA\Property(property="mapa_id", type="integer", example=1),
 *   @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-15T10:00:00Z"),
 *   @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-20T15:30:00Z"),
 * 
 * )
 * 
 * @OA\Schema(
 *   schema="PontoID",
 *   type="object",
 *
 *   @OA\Property(property="id", type="integer", example=2),
 *   @OA\Property(property="nome", type="string", example="Campinas"),
 *   @OA\Property(
 *     property="descricao",
 *     type="string",
 *     example="",
 *     nullable=true
 *   ),
 *  @OA\Property(property="latitude", type="number", format="float", example=-22.9065385),
 *  @OA\Property(property="longitude", type="number", format="float", example=-47.0475769),
 *  @OA\Property(property="mapa_id", type="integer", example=3),
 *   @OA\Property(property="created_at", type="string", format="date-time", example="2025-12-29T23:21:51.000000Z"),
 *   @OA\Property(property="updated_at", type="string", format="date-time", example="2025-12-29T23:21:51.000000Z"),
 *   @OA\Property(
 *     property="mapa",
 *     ref="#/components/schemas/Mapa"
 *   )
 * )
 */
class Ponto {}
