<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica el rol, para acceso de cosas especificas
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'No tienes permiso para acceder aquí.');
        }

        return $next($request);
    }
}