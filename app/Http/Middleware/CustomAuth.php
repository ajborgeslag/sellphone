<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request,Closure $next )
    {
        if(!empty(session('authenticated'))){
            $request->session()->put('authenticated',time());
            return $next($request);
        }

        return redirect('/loguin');
    }
}
