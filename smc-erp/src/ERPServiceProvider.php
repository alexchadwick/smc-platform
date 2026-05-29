<?php

namespace SMC\ERP;

use Illuminate\Support\ServiceProvider;;

class ERPServiceProvider extends ServiceProvider {

    //private $configPath = __DIR__.'/config/training.php';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        //Database
        $this->loadMigrationsFrom(__DIR__.'/database/migrations', 'smc-erp');

        //Views
        $this->loadViewsFrom(__DIR__.'/Http/resources/views', 'smc-erp');

        //Routes
        //Load web routes
        $this->loadRoutesFrom(__DIR__.'/Http/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/Http/routes/api.php');

        //Publish public assets
        $this->publishes([__DIR__.'/public' => public_path('vendor/smc/smc-erp'),], 'public');

        //Config, Database Seeder, Database Migrations
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('smc-erp.php'),
            ], 'config');
            $this->publishes([
                __DIR__ . '/database/seeders/' => database_path('seeders/'),
            ], 'seeds');
            $this->publishes([
                __DIR__ . '/database/migrations/' => database_path('migrations/smc-erp'),
            ], 'migrations');
        }
        //Publish config file
       // $this->publishes([$this->configPath => config_path('smc-training.php'),]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'smc-erp');

        //$this->mergeConfigFrom($this->configPath, 'smc-training');

        // Register the main class to use with the facade
      /*  $this->app->singleton('laravel-quiz', function () {
            return new LaravelQuiz();
        });*/
    }
}

