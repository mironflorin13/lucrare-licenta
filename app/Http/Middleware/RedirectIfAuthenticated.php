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
        
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }
        //aici verific daca sunt deja conectat ca si dentist atunci o sa ma trimita pe pagina principala
        switch ($guard) {
            case 'dentist':
                if (Auth::guard($guard)->check()) {
                     return redirect()->route('dentist.dashboard');
                }
                break;
            
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/home');
                }
                break;
        }
        return $next($request);
    }
}
