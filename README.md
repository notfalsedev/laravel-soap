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
        "artisaninweb/laravel-soap": "0.3.*"
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

namespace App\Http\Controllers;

use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Soap\Request\GetConversionAmount;
use App\Soap\Response\GetConversionAmountResponse;

class SoapController
{
  /**
   * @var SoapWrapper
   */
  protected $soapWrapper;

  /**
   * SoapController constructor.
   *
   * @param SoapWrapper $soapWrapper
   */
  public function __construct(SoapWrapper $soapWrapper)
  {
    $this->soapWrapper = $soapWrapper;
  }

  /**
   * Use the SoapWrapper
   */
  public function show() 
  {
    $this->soapWrapper->add('Currency', function ($service) {
      $service
        ->wsdl('http://currencyconverter.kowabunga.net/converter.asmx?WSDL')
        ->trace(true)
        ->classmap([
          GetConversionAmount::class,
          GetConversionAmountResponse::class,
        ]);
    });

    $response = $this->soapWrapper->call('Currency.GetConversionAmount', [
      new GetConversionAmount('USD', 'EUR', '2014-06-05', '1000')
    ]);

    var_dump($response);
    exit;
  }
}
```