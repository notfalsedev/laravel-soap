<?php

namespace Artisaninweb\SoapWrapper;

class ServiceProvider extends \Illuminate\Support\ServiceProvider {

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
        $this->app->bindIf('SoapWrapper', function()
        {
            return new \Artisaninweb\SoapWrapper\Wrapper();
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