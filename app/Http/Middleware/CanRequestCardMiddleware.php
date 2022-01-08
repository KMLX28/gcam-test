<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanRequestCardMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth('web')->check() && !auth('web')->user()->trusted) {
            return redirect()->route('welcome');
        }

        return $next($request);
    }
}
