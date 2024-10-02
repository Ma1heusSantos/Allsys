<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class adminAcess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       if(auth()->check()){
        return redirect()->route('home');
       }elseif((auth()->check() && auth()->user()->nivel === 'Admin')){
            return $next($request);
       }else{
        return redirect()->route('home');
       }
       
    }
}