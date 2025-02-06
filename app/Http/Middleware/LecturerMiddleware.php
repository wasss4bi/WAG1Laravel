<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LecturerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /* if (Auth::check() && Auth::user()->role === 0) {
        } */
        if(Auth::check()){
            if(Auth::user()->role === 'lector'){
                return $next($request);
            }
        }
        return redirect()->route('main.index');
        /* abort(403, 'Forbidden'); */
    }
}
