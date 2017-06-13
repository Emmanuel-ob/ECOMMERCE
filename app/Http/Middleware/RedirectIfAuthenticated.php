<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
    //     if (Auth::guard($guard)->check()) {
    //         return redirect('/home');
    //     }
    switch($guard){
        case 'admin':
        
            $redirect = redirect()->route('admin.dashboard');
            break;

        default:
            $redirect = redirect('/cart');
             break;  
        }
    if(Auth::guard($guard)->check()){
       return $redirect;
    }

        return $next($request);
    }
}
