<?php

namespace Artisaninweb\SoapWrapper;

use \Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider {

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Nothing here
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindIf('SoapWrapper', function () {
            return new Wrapper();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        // Nothing here
    }

}