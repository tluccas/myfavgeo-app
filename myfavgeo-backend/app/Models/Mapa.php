<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mapa extends Model
{

    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'url_imagem',
    ];


    protected function nome(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => ucfirst($value ?? ''),
            set: fn (?string $value) => trim($value ?? ''),
        );
    }

    protected function descricao(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => ucfirst($value ?? ''),
            set: fn (?string $value) => trim($value ?? ''),
        );
    }

    protected function urlImagem(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => filter_var($value, FILTER_VALIDATE_URL) ? $value : asset($value),
            set: fn (?string $value) => trim($value ?? ''),
        );
    }

    public function pontos(): HasMany
    {
        return $this->hasMany(Ponto::class);
    }

    public function getResumo(int $limite = 50): string
    {
        return str($this->descricao)->limit($limite);
    }



}
