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

    use AuthenticatesUsers{
        login as authLogin;
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

    public function login(Request $request)
    {
        $value = $this->authLogin($request);

        $haha = \DB::select("call Login('" . $request['email']. "','" .bcrypt($request['password'])."')");
        \DB::purge('mysql');
        \Config::set('database.connections.mysql.username', $haha[0]->user_name);
        \Config::set('database.connections.mysql.password', $haha[0]->decrypted_password);
        $haha = \DB::select("call Login('" . $request['email']. "','" .bcrypt($request['password'])."')");

        return $value;
    }


}
