<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SignatureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $header
     * @return mixed
     */
    public function handle($request, Closure $next, $header = "X-Name")
    {
        $response = $next($request);

        $response->headers->set($header, config('app.name'));

        return $response;
    }
}
