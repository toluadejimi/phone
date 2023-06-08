<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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
   // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['email_verified_at'] = !is_null($request->user()) ? null : now();
    
        return $credentials;
    }
    
    public function redirectTo()
    {
        if (Auth::user()->role == 'user') {
            return  $this->redirectTo='/user/dashboard';
        }
        elseif (Auth::user()->role == 'admin') {
            $this->redirectTo='/admin/dashboard';
            return $this->redirectTo;           
        }
      
       $this->middleware('guest')->except('logout');
   }
}
