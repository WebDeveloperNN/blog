<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Technology;

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
        // чтобы передать данные в тот или иной шаблон
        view()->composer('components.menu', function ($view) {
            $view->with('technologies', Technology::all());
        });



    }
}
