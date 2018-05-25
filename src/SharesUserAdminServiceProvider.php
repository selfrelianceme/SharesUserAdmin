<?php

namespace Selfreliance\SharesUserAdmin;

use Illuminate\Support\ServiceProvider;

class SharesUserAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        include __DIR__.'/routes.php';
        $this->app->make('Selfreliance\SharesUserAdmin\SharesUserAdminController');
        $this->loadViewsFrom(__DIR__.'/views', 'sharesuseradmin');

        $this->publishes([
            __DIR__.'/public/' => public_path('vendor/sharesuseradmin'),
        ], 'assets');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}