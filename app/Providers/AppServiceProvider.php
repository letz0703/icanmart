<?php

namespace App\Providers;

use App\Observers\ProjectObserver;
use App\Observers\TaskObserver;
use App\Project;
use App\Seller;
use App\Task;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;



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
        Blade::directive('money', function($amount){
            return "<?php echo number_format($amount).' 원' ?>";
        });

        \View::composer('*', function ($view){
            $sellers = \Cache::rememberForever('sellers', function (){
                return Seller::all();
            });

            $view->with('sellers', $sellers);
        });

        Carbon::setLocale(config('app.locale'));

        //Project::observe(ProjectObserver::class);
        //Task::observe(TaskObserver::class);

    }
}
