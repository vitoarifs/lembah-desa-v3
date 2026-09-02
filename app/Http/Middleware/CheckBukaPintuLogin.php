<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBukaPintuLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika tidak ada session rahasia, pura-pura halaman tidak ditemukan (404)
        if (!session('buka_pintu_login')) {
            abort(404);
        }

        return $next($request);
    }
}
