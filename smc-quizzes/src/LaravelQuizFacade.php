<?php

namespace Quiz;

use Illuminate\Support\Facades\Facade;

class LaravelQuizFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-quiz';
    }
}
