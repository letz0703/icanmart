<?php

namespace App\Providers;

use App\Observers\ProjectObserver;
use App\Observers\TaskObserver;
use App\Project;
use App\Seller;
use App\Task;
use Carbon\Carbon;
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
        if ($this->app->isLocal()){
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::composer('*', function ($view){
            $sellers = \Cache::rememberForever('sellers', function (){
                return Seller::all();
            });

            $view->with('sellers', $sellers);
        });

        Carbon::setLocale(config('app.locale'));

        Project::observe(ProjectObserver::class);
        Task::observe(TaskObserver::class);

    }
}
