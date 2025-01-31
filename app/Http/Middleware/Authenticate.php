<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $routeMiddleware = \Route::current()->middleware();
        $guard = $routeMiddleware[1];
        if ($guard == 'auth:user')  return $request->expectsJson() ? null : route('login');
        if ($guard == 'auth:seller')  return $request->expectsJson() ? null : route('memberLogin');

    }
}
