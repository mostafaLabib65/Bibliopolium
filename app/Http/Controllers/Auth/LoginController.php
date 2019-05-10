<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    use AuthenticatesUsers {
        login as authLogin;
        logout as authLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    protected function authenticated(Request $request, $user)
    {
        $credentials = \DB::select("call Login('" . $request['email']. "','" .bcrypt($request['password'])."')");
        \DB::purge('mysql');
        \Config::set('database.connections.mysql.username', $credentials[0]->user_name);
        \Config::set('database.connections.mysql.password', $credentials[0]->decrypted_password);
    }



    public function logout(Request $request)
    {
        $user = auth()->user()->id;
        \DB::select("CALL LOGOUT( $user ) ");
        return $this->authLogout($request);
    }


}
