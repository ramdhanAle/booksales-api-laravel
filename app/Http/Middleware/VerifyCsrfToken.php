<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\Hash;
use illuminate\Support\Facades\Session;
use illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\DB;
use illuminate\Support\Facades\Cookie;
use illuminate\Support\Facades\URL;
use illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Symfony\Component\HttpFoundation\Response;

class VerifyCsrfToken
{
    protected $except = [
        'api/*',
        'genres',
        'authors',
        'books/*'
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
