<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttachJwtFromCookie
{
    public function handle(Request $request, Closure $next): Response
    {
        // Se não tem Bearer token no header, mas tem o cookie 'token'
        if (!$request->bearerToken() && $request->hasCookie('token')) {
            $token = $request->cookie('token');

            // Injeta o token no header Authorization para o JWTAuth ler
            $request->headers->set('Authorization', 'Bearer ' . $token);
        }

        return $next($request);
    }
}
