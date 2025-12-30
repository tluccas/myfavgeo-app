<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *   schema="User",
 *   type="object",
 *
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="nome", type="string", example="Teste"),
 *   @OA\Property(property="email", type="string", format="email", example="teste@teste.com"),
 *   @OA\Property(property="created_at", type="string", format="date-time", example="2025-12-29T17:41:35.000000Z"),
 *   @OA\Property(property="updated_at", type="string", format="date-time", example="2025-12-29T17:41:35.000000Z")
 * )
 */
class User {}
