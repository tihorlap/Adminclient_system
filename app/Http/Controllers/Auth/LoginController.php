<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // Make sure to import this


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
      
     */
    //protected $redirectTo = '/home';

    // protected function redirectTo() {
    //      // Check if user is an admin
    //     if (Auth::user()->role === 'admin') {
    //         return '/admin/dashboard'; // Redirect admin to admin dashboard
    //     } 
    //     // Default redirect for clients
    //     return '/client/dashboard';
    // }
    protected function authenticated(Request $request, $user)
  {
    if ($user->role === 'admin') {
        return redirect('/dashboard');
    }
    return redirect('/client/dashboard');
  }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
