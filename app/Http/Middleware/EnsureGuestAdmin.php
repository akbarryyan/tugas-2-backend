<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureGuestAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user('sanctum')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah login, logout terlebih dahulu',
            ], 403);
        }

        return $next($request);
    }
}
