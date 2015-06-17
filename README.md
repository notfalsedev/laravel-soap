Laravel SoapClient Wrapper
===========================

A SoapClient wrapper integration for Laravel.<br />
The documentation will be updated in time.

Installation
============

Add `artisaninweb/laravel-soap` as requirement to composer.json

```javascript
{
    "require": {
        "artisaninweb/laravel-soap": "0.2.*"
    }
}
```

Add the service provider in `app/config/app.php`.

```php
'Artisaninweb\SoapWrapper\ServiceProvider'
```

To use the facade add this to the facades in `app/config/app.php`.

```php
'SoapWrapper' => 'Artisaninweb\SoapWrapper\Facades\SoapWrapper'
```

Usage
============

How to add a service to the wrapper and use it.

```php
<?php

use Artisaninweb\SoapWrapper\Facades\SoapWrapper;

class SoapController {

    public function demo()
    {
        // Add a new service to the wrapper
        SoapWrapper::add(function ($service) {
            $service
                ->name('currency')
                ->wsdl('http://currencyconverter.kowabunga.net/converter.asmx?WSDL')
                ->trace(true)                                                   // Optional: (parameter: true/false)
                ->header()                                                      // Optional: (parameters: $namespace,$name,$data,$mustunderstand,$actor)
                ->customHeader($customHeader)                                   // Optional: (parameters: $customerHeader) Use this to add a custom SoapHeader or extended class                
                ->cookie()                                                      // Optional: (parameters: $name,$value)
                ->location()                                                    // Optional: (parameter: $location)
                ->certificate()                                                 // Optional: (parameter: $certLocation)
                ->cache(WSDL_CACHE_NONE)                                        // Optional: Set the WSDL cache
                ->options(['login' => 'username', 'password' => 'password']);   // Optional: Set some extra options
        });

        $data = [
            'CurrencyFrom' => 'USD',
            'CurrencyTo'   => 'EUR',
            'RateDate'     => '2014-06-05',
            'Amount'       => '1000'
        ];

        // Using the added service
        SoapWrapper::service('currency', function ($service) use ($data) {
            var_dump($service->getFunctions());
            var_dump($service->call('GetConversionAmount', [$data])->GetConversionAmountResult);
        });
    }

}
```

Usage as model extension
============

Like Eloquent you can extent the SoapService on your model.
See example:

```php
<?php

use Artisaninweb\SoapWrapper\Extension\SoapService;

class Soap extends SoapService {

    /**
     * @var string
     */
    protected $name = 'currency';

    /**
     * @var string
     */
    protected $wsdl = 'http://currencyconverter.kowabunga.net/converter.asmx?WSDL';
    
    /**
     * @var boolean
     */
    protected $trace = true;

    /**
     * Get all the available functions
     *
     * @return mixed
     */
    public function functions()
    {
        return $this->getFunctions();
    }

}
```