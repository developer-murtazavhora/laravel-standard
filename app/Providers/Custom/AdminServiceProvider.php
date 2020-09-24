<?php

namespace App\Providers\Custom;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Interfaces\CategoriesInterface', 'App\Repositories\CategoriesRepository');
        $this->app->bind('App\Interfaces\ProductsInterface', 'App\Repositories\ProductsRepository');
        $this->app->bind('App\Interfaces\UsersInterface', 'App\Repositories\UsersRepository');
    }
}
