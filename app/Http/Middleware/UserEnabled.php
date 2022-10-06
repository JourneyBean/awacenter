<?php

namespace App\Http\Middleware;

use Closure;

class UserEnabled
{
    public function handle($request, Closure $next)
    {
        if (!($request->user() ? $request->user()->enabled : false)) {
            return redirect()->route('home');
        }
 
        return $next($request);
    }
}
