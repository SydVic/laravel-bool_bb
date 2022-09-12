<?php

namespace App\Http\Middleware;

use Closure;

class HasApartments
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->check() || !auth()->user()->hasApartments()){
            return redirect()->route('user.apartment.create');
        }
        return $next($request);
    }
}
