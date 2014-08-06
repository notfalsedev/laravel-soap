Laravel SoapClient Wrapper
===========================

A SoapClient wrapper integration for Laravel.
The documentation will be updated in time.

Installation
============

Add `artisaninweb/laravel-soap` as requiremtn to composer.json

```javascript
{
    "require": {
        "artisaninweb/laravel-soap": "0.1"
    }
}
```

Add the service provider in `app/config/app.php`.

```php
'Artisaninweb\SoapWrapper\ServiceProvider'
```

To use the facade add this to the facades in `app/config/app.php`.

```php
'SoapWrapper' => 'Artisaninweb\SoapWrapper\Facade'
```

Usage
============

How to add a service to the wrapper

```php
SoapWrapper::add(function ($service) {
    $service->name('currency')->wsdl('http://currencyconverter.kowabunga.net/converter.asmx?WSDL');
});
```

How to use a added service

```php
$data = array(
    'CurrencyFrom' => 'USD',
    'CurrencyTo'   => 'EUR',
    'RateDate'     => '2014-06-05',
    'Amount'       => '1000'
);

SoapWrapper::service('currency',function($service) use ($data) {
    var_dump($service->getFunctions());
    var_dump($service->call('GetConversionAmount',$data)->GetConversionAmountResult);
});
```