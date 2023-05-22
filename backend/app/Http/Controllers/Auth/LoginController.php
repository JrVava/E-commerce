<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo;// = RouteServiceProvider::HOME;
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */



  
    public function __construct()
    {
        // $this->middleware('admin');
        $this->middleware('guest')->except('logout');
    }

    // protected function authenticated(Request $request, $user)
    // {
    //     if ($user->isAdmin()->name === 'admin') {
    //         return redirect()->route('category');
    //     }
    // }
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            if (Auth::check()) {
                $user = Auth::user();
                
                if ($user->isAdmin()->name == 'admin') {
                    return redirect()->route('category');
                }
            }
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
        return redirect()->route('login')->with('message','Sorry, From Controller you are not a authorized administrator');
    }

}