<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisableCsrfForApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Nonaktifkan CSRF untuk semua route API
        if (str_starts_with($request->path(), 'api')) {
            config(['session.driver' => 'array']);
        }

        return $next($request);
    }
}
