<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
    public function handle(Request $request, Closure $next)
{
    $response = $next($request);

    // Allow all origins untuk development
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, PATCH');
    $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, Accept, Origin, X-CSRF-TOKEN');
    $response->headers->set('Access-Control-Expose-Headers', 'Content-Disposition, Content-Length');
    $response->headers->set('Access-Control-Allow-Credentials', 'true');

    // Handle preflight requests
    if ($request->getMethod() === 'OPTIONS') {
        $response->setStatusCode(200);
        $response->setContent('OK');
    }

    return $response;
}
}