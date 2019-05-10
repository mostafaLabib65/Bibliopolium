<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Book' => 'App\Models\Policies\BookPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });

        if(\Auth::check()){
            $email = auth()->user()->email;
            $credentials = \DB::select("call Login('$email','')");
            \DB::purge('mysql');
            \Config::set('database.connections.mysql.username', $credentials[0]->user_name);
            \Config::set('database.connections.mysql.password', $credentials[0]->decrypted_password);
        }
    }
}
