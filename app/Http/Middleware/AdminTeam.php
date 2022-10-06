<?php

namespace App\Http\Middleware;

use Closure;

class AdminTeam
{
    public function handle($request, Closure $next)
    {
        if (!($request->user() ? $request->user()->admin : false)) {
            return redirect()->route('home');
        }
 
        return $next($request);
    }
}
