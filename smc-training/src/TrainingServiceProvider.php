<?php

namespace Training;

use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;


class TrainingServiceProvider extends ServiceProvider {

    private $configPath = __DIR__.'/config/training.php';

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
        $this->loadViewsFrom(__DIR__.'/Http/resources/views', 'smc-training');

        //Routes
        //Load web routes
        $this->loadRoutesFrom(__DIR__.'/Http/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/Http/routes/api.php');

        //Publish public assets
        $this->publishes([__DIR__.'/public' => public_path('vendor/smc/smc-training'),], 'public');

        //Config, Database Seeder, Database Migrations
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('smc-training.php'),
            ], 'config');
            $this->publishes([
                __DIR__ . '/database/seeders/' => database_path('seeders/'),
            ], 'seeds');
            $this->publishes([
                __DIR__ . '/database/migrations/' => database_path('migrations/smc-training'),
            ], 'migrations');
        }

        //Publish config file
       // $this->publishes([$this->configPath => config_path('smc-training.php'),]);


        foreach (config('smc-training.models') as $key => $model) {
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
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'smc-training');

        //$this->mergeConfigFrom($this->configPath, 'smc-training');

    }
}

