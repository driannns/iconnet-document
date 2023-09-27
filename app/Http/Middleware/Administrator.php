<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Administrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $administrator = User::whereHas('roles', function($query){
            $query->whereIn('name', ['administrator']);
        })->get();

        if(count($administrator) == 0){
            return redirect()->route('register');
        } else{
            return $next($request);
        }
    }
}
