<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado y es administrador
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->isAdmin()) {
            abort(403, 'Acceso no autorizado. Se requieren permisos de administrador.');
        }

        return $next($request);
    }
}
