<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Access Role Admin
        Gate::define('admin', function(User $user){
            return $user->role === 'admin';
        });


        // Access Role JKN
        Gate::define('JKN', function(User $user){
            return $user->role === 'JKN';
        });


        // Access Role kepala ruangan
        Gate::define('kepala ruangan', function(User $user){
            return $user->role === 'kepala ruangan';
        });
    }
}
