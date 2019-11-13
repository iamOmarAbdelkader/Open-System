<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Schema;
use View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        View::composer('partials.side-bar', function ($view) {
            //
           if(auth()->check()){
            //    because in the logic of the app every user has only one role and multiple permissions
              $perms = auth()->user()->roles()->first()->perms()->pluck('name')->toArray();
              $view->with('perms',$perms);
           }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
