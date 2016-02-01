<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Collective\Annotations\AnnotationsServiceProvider as ServiceProvider2;


class AnnotationsServiceProvider extends ServiceProvider2
{



     /**
     * The classes to scan for event annotations.
     *
     * @var array
     */
    protected $scanEvents = [        
    ];

    /**
     * The classes to scan for route annotations.
     *
     * @var array
     */
    protected $scanRoutes = [
        'App\Http\Controllers\HomeController',
    ];

    /**
     * The classes to scan for model annotations.
     *
     * @var array
     */
    protected $scanModels = [
        'App\User',
    ];

    /**
     * Determines if we will auto-scan in the local environment.
     *
     * @var bool
     */
    protected $scanWhenLocal = false;

    /**
     * Determines whether or not to automatically scan the controllers
     * directory (App\Http\Controllers) for routes
     *
     * @var bool
     */
    protected $scanControllers = false;

    /**
     * Determines whether or not to automatically scan all namespaced
     * classes for event, route, and model annotations.
     *
     * @var bool
     */
    protected $scanEverything = false;

}
