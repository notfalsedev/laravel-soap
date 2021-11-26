<?php

namespace Artisaninweb\SoapWrapper;

use Artisaninweb\SoapWrapper\Contracts\ServiceFactory as ServiceFactoryContract;
use Artisaninweb\SoapWrapper\Contracts\SoapWrapper as SoapWrapperContract;
use \Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if (is_array($soapWrapperConfig = $this->app['config']['soapwrapper'])) {
            $this->app[SoapWrapperContract::class]->addByArray($soapWrapperConfig);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindIf(
            ServiceFactoryContract::class,
            ServiceFactory::class
        );

        $this->app->bindIf(
            SoapWrapperContract::class,
            function ($app) {
                return new SoapWrapper($app[ServiceFactoryContract::class]);
            }
        );
    }
}
