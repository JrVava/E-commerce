<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateAPI extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards)
    {
        // Your middleware logic...
    
        if(isset($request->route()->uri)){
            $requestParameter = explode('/', $request->route()->uri);
            $removeBearer = explode(' ',$request->header('Authorization'));
            
            if(isset($removeBearer[1])){
                $user = User::where('api_token','=',$removeBearer[1])->first();
            }
            $token = '';
            if(isset($user) && !is_null($user)){
                $token = isset($user->api_token) ? $user->api_token : '';
            }
            if(isset($requestParameter[0]) && $token == ''){
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
        }
        return $next($request);
    }
}
