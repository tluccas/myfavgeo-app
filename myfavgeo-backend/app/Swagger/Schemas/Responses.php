<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *   schema="ApiSuccess",
 *   type="object",
 *   required={"success","message"},
 *
 *   @OA\Property(property="success", type="boolean", example=true),
 *   @OA\Property(property="message", type="string", example="Operação realizada com sucesso"),
 *   @OA\Property(
 *     property="data",
 *     type="object",
 *     nullable=true,
 *     description="Payload de resposta"
 *   )
 * )
 *
 * @OA\Schema(
 *   schema="ApiError",
 *   type="object",
 *   required={"success","message"},
 *
 *   @OA\Property(property="success", type="boolean", example=false),
 *   @OA\Property(property="message", type="string", example="Erro de validação"),
 *   @OA\Property(
 *     property="errors",
 *     type="object",
 *     nullable=true,
 *     description="Detalhes do erro",
 *     example={
 *       "nome": {"O campo nome deve ser um texto."}
 *     }
 *   )
 * )
 */
class Responses {}
