<?php

namespace App\Providers;

use App\Seller;
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
        \View::composer('boxes.create', function ($view){
            $view->with('sellers', Seller::all());
        });
    }
}
