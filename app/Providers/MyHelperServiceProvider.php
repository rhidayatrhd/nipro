<?php

namespace App\Providers;

use App\Models\User;
use App\Models\ProductCategory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class MyHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once \app_path('Helpers/myHelper.php');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Gate::define('admin', function (User $user) {
            return $user->is_admin || $user->userrole->role === 'Admin';
        });
 
        $menuItems = ProductCategory::all();
        \view()->share('menuItems', $menuItems);
    }
}
