<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'latitude',
        'longitude',
        'mapa_id'
    ];


    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'mapa_id' => 'integer'
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
            set: fn (string $value) => trim($value ?? ''),
        );
    }

    public function mapa()
    {
        return $this->belongsTo(Mapa::class);
    }

    public function getCoordenadasFormatadas(): string
    {
        return "Lat: {$this->latitude}, Lon: {$this->longitude}";
    }

    public function getResumo(int $limite = 50): string
    {
        return str($this->descricao)->limit($limite);
    }
}
