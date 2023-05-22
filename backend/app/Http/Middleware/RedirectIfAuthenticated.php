<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\LoginController;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // if (Auth::guard($guards)->check() && Auth::user()->role_id == 1) {
        //     return redirect()->route('category');
        // } else {
        //     return $next($request);
        // }
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // if (Auth::guard($guard)->check()) {
            //     return redirect(RouteServiceProvider::HOME);
            // }

            if (Auth::guard($guard)->check()) {
                // dd(Auth::guard($guard)->user()->isAdmin()->name);
                if(Auth::guard($guard)->user()->isAdmin()->name == "admin"){
                    return redirect(RouteServiceProvider::HOME);
                }elseif(Auth::guard($guard)->user()->isAdmin()->name == "user"){
                   // return response()->json(['error' => 'Unauthorized'], 401);
                }else{
                    return redirect(RouteServiceProvider::HOME);
                }
            }
        }

        return $next($request);
    }
}
