<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // return redirect(RouteServiceProvider::ADMISSION);
                // Check roles of the user authenticated
                if(Auth::user()->role == 0) {
                    return redirect()->intended('/superadmin');
                } else if(Auth::user()->role == 1) {
                    return redirect()->intended('/admission');
                } else if(Auth::user()->role == 2) {
                    return redirect()->intended('/chairperson');
                } else if(Auth::user()->role == 3) {
                    return redirect()->intended('/dean');
                } else {
                    return redirect()->intended('/login');
                }
            }
        }

        return $next($request);
    }
}
