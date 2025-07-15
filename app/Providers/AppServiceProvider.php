<?php

namespace App\Providers;

use App\Models\CollectionPoint as Point;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap();

        Gate::define('user_can_edit', function(User $user, Point $point) {
            return ($user->id === $point->user->id || $user->email === 'admin@gmail.com');
        });
        Gate::define('user_can_delete', function(User $user, Point $point){
            return ($user->id === $point->user->id || $user->email === 'admin@gmail.com');
        });
    }
}
