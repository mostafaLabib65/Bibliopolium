<?php

namespace App\Http\Middleware;

use Closure;

class AlterDBConfig
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->guest()){
            $email = auth()->user()->email;
            $credentials = \DB::select("call Login('$email','')");
            \DB::purge('mysql');
            \Config::set('database.connections.mysql.username', $credentials[0]->user_name);
            \Config::set('database.connections.mysql.password', $credentials[0]->decrypted_password);
        }
        return $next($request);
    }
}
