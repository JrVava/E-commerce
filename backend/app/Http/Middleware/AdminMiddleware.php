<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($request->user());
        if (is_null($request->user())) {
            return redirect()->route('login')->with('message','Sorry,Please Login');
        }elseif($request->user()->isAdmin()->name !== 'admin'){
            return redirect()->route('login')->with('message','Sorry, you are not a authorized administrator');
        }
        return $next($request);
    }
}
