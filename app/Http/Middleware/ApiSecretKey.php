<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiSecretKey
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('api_secret_key') && $request->header('api_secret_key') == env('API_SECRET_KEY')) {
            return $next($request);
        } else {
            return throw new AuthorizationException();
        }
    }
}
