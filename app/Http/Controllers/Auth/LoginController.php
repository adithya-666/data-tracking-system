<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    // use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $credentials =   $request->validate([
            'user_name' => ['required'],
            'password' => ['required']
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }

        return back()->with('LoginError', 'Login Failed !!!' );

       
    }

    public function logout(Request $request) {

        
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
