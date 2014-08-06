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
        $this->app->bindIf('SoapWrapper', function()
        {
            return new \Artisaninweb\SoapWrapper\Wrapper();
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Nothing here
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