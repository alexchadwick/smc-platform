<?php

namespace Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider {


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        //Database
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        //Views
        $this->loadViewsFrom(__DIR__.'/Http/resources/views', 'smc-admin');

        //Routes
        //Load web routes
        $this->loadRoutesFrom(__DIR__.'/Http/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/Http/routes/api.php');

        //Publish public assets
        $this->publishes([__DIR__.'/public' => public_path('vendor/smc/smc-admin'),], 'public');

        //Config, Database Seeder, Database Migrations
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('smc-admin.php'),
            ], 'config');
            $this->publishes([
                __DIR__ . '/database/seeders/' => database_path('seeders/'),
            ], 'seeds');
            $this->publishes([
                __DIR__ . '/database/migrations/' => database_path('migrations/smc-admin'),
            ], 'migrations');
        }

        foreach (config('smc-admin.models') as $key => $model) {
            \Illuminate\Support\Facades\Route::model($key, $model);
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'smc-admin');

    }
}

