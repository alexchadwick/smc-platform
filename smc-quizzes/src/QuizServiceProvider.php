<?php

namespace Quiz;

use Illuminate\Support\ServiceProvider;
use Quiz\LaravelQuiz;

class QuizServiceProvider extends ServiceProvider {

    //private $configPath = __DIR__.'/config/training.php';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        //Database
        $this->loadMigrationsFrom(__DIR__.'/database/migrations', 'smc-quizzes');

        //Views
        $this->loadViewsFrom(__DIR__.'/Http/resources/views', 'smc-quizzes');

        //Routes
        //Load web routes
        $this->loadRoutesFrom(__DIR__.'/Http/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/Http/routes/api.php');

        //Publish public assets
        $this->publishes([__DIR__.'/public' => public_path('vendor/smc/smc-quizzes'),], 'public');

        //Config, Database Seeder, Database Migrations
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('smc-quizzes.php'),
            ], 'config');
            $this->publishes([
                __DIR__ . '/database/seeders/' => database_path('seeders/'),
            ], 'seeds');
            $this->publishes([
                __DIR__ . '/database/migrations/' => database_path('migrations/smc-quizzes'),
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
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'smc-quizzes');

        //$this->mergeConfigFrom($this->configPath, 'smc-training');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-quiz', function () {
            return new LaravelQuiz();
        });
    }
}

