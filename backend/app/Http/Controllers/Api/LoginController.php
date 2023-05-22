<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // dd("hello");
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($request->all())) {
            $user = Auth::user();
            if ($user->isAdmin()->name == "user") {
                $token = $user->createToken('API Token')->plainTextToken;
                User::where('id', '=', $user->id)->update(['api_token' => $token]);
                return response()->json(['token' => $token], 200);
            } else {
                return response()->json(['message' => 'Sorry, You are unauthorized person'], 200);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}