<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected $redirectTo ='/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Auth::check() && Auth::user()->role_name ==='superadmin') {
            return redirect()->route('adminDashboard');
        }elseif(Auth::check() && Auth::user()->role_name==='seller'){
            return redirect()->route('sellerdashboard');
        }elseif (Auth::check() && Auth::user()->role_name==='user') {
            return redirect()->route('home');
        }
        $this->middleware('guest')->except('logout');
    }
}
