<?php

namespace App\Providers;

use App\Services\Foto;
use Illuminate\Support\ServiceProvider;

class FotoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('foto', function () {
            return new Foto();
        });
    }
}
