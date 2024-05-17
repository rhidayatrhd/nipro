<?php

namespace App\Providers;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Pagination\Paginator;
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
        // Paginator::useBootstrap();
        // Gate::define('admin', function(User $user) {
        //     return $user->is_admin || $user->userrole->role === 'Admin';
        // });

        // $menuItems = ProductCategory::all();
        // \view()->share('menuItems', $menuItems);
    }
}
