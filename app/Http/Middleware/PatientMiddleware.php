<?php

namespace App\Http\Middleware;

use Closure;

class PatientMiddleware
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
        if ($request->user() && $request->user()->function != 'patient')
        {
            return new Response(view('unauthorized')->with('role', 'PATIENT'));
        }
        return $next($request);
    }
}
