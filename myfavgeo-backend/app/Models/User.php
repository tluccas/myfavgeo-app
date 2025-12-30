<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{

    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Implementação dos metódos do JWTSubject

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // Acessors e Mutators

    protected function nome(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => ucfirst($value ?? ''),
            set: fn (?string $value) => trim($value ?? ''),
        );
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => strtolower($value ?? ''),
            set: fn (?string $value) => trim(strtolower($value ?? '')),
        );
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => bcrypt($value),
        );
    }

    // Relacionamentos

    public function mapas()
    {
        return $this->hasMany(Mapa::class);
    }
}
