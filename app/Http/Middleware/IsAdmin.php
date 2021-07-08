<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->hasRole('admin') ){
            return $next($request);
        }
        return response()->json([
            "status" => false,
            "error" => "Forbidden",
            "data" => null,
            "code" => 402 
        ]);
    }
}