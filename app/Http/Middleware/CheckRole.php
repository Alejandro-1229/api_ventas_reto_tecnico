<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    { 

            $user = Auth::user();
            $roleIds = array_map('intval', $roles);
            if (!in_array($user->role_id, $roleIds)) {
                return response()->json(['error' => 'No tienes permiso para acceder a esta ruta.'], 403);
            }

            return $next($request);
        
    }
}
