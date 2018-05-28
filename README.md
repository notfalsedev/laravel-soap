Laravel SoapClient Wrapper
===========================

A SoapClient wrapper integration for Laravel.<br/>
Makes it easy to use Soap in a Laravel application.<br/>

Please report any bugs or features here: <br/>
https://github.com/artisaninweb/laravel-soap/issues/

Installation
============

## Laravel

####Installation for Laravel 5.2 and above:

Run `composer require artisaninweb/laravel-soap`

Add the service provider in `app/config/app.php`.

```php
Artisaninweb\SoapWrapper\ServiceProvider::class, 
```

To use the alias, add this to the aliases in `app/config/app.php`.

```php
'SoapWrapper' => Artisaninweb\SoapWrapper\Facade\SoapWrapper::class,  
```


####Installation for Laravel 5.1 and below :


Add `artisaninweb/laravel-soap` as requirement to composer.json

```javascript
{
    "require": {
        "artisaninweb/laravel-soap": "0.3.*"
    }
}
```

> If you're using Laravel 5.5 or higher you can skip the two config setups below.

Add the service provider in `app/config/app.php`.

```php
'Artisaninweb\SoapWrapper\ServiceProvider'
```

To use the facade add this to the facades in `app/config/app.php`.

```php
'SoapWrapper' => 'Artisaninweb\SoapWrapper\Facade'
```

## Lumen

Open `bootstrap/app.php` and register the required service provider:
```php
$app->register(Artisaninweb\SoapWrapper\ServiceProvider::class);
```

register class alias:
```php
class_alias('Artisaninweb\SoapWrapper\Facade', 'SoapWrapper');
```

*Facades must be enabled.*


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

    // Without classmap
    $response = $this->soapWrapper->call('Currency.GetConversionAmount', [
      'CurrencyFrom' => 'USD', 
      'CurrencyTo'   => 'EUR', 
      'RateDate'     => '2014-06-05', 
      'Amount'       => '1000',
    ]);

    var_dump($response);

    // With classmap
    $response = $this->soapWrapper->call('Currency.GetConversionAmount', [
      new GetConversionAmount('USD', 'EUR', '2014-06-05', '1000')
    ]);

    var_dump($response);
    exit;
  }
}
```

Service functions
============
```php
$this->soapWrapper->add('Currency', function ($service) {
    $service
        ->wsdl()                 // The WSDL url
        ->trace(true)            // Optional: (parameter: true/false)
        ->header()               // Optional: (parameters: $namespace,$name,$data,$mustunderstand,$actor)
        ->customHeader()         // Optional: (parameters: $customerHeader) Use this to add a custom SoapHeader or extended class                
        ->cookie()               // Optional: (parameters: $name,$value)
        ->location()             // Optional: (parameter: $location)
        ->certificate()          // Optional: (parameter: $certLocation)
        ->cache(WSDL_CACHE_NONE) // Optional: Set the WSDL cache
    
        // Optional: Set some extra options
        ->options([
            'login' => 'username',
            'password' => 'password'
        ])

        // Optional: Classmap
        ->classmap([
          GetConversionAmount::class,
          GetConversionAmountResponse::class,
        ]);
});
```

Classmap
============

If you are using classmap you can add folders like for example:
- App\Soap
- App\Soap\Request
- App\Soap\Response

Request: App\Soap\Request\GetConversionAmount

```php
<?php

namespace App\Soap\Request;

class GetConversionAmount
{
  /**
   * @var string
   */
  protected $CurrencyFrom;

  /**
   * @var string
   */
  protected $CurrencyTo;

  /**
   * @var string
   */
  protected $RateDate;

  /**
   * @var string
   */
  protected $Amount;

  /**
   * GetConversionAmount constructor.
   *
   * @param string $CurrencyFrom
   * @param string $CurrencyTo
   * @param string $RateDate
   * @param string $Amount
   */
  public function __construct($CurrencyFrom, $CurrencyTo, $RateDate, $Amount)
  {
    $this->CurrencyFrom = $CurrencyFrom;
    $this->CurrencyTo   = $CurrencyTo;
    $this->RateDate     = $RateDate;
    $this->Amount       = $Amount;
  }

  /**
   * @return string
   */
  public function getCurrencyFrom()
  {
    return $this->CurrencyFrom;
  }

  /**
   * @return string
   */
  public function getCurrencyTo()
  {
    return $this->CurrencyTo;
  }

  /**
   * @return string
   */
  public function getRateDate()
  {
    return $this->RateDate;
  }

  /**
   * @return string
   */
  public function getAmount()
  {
    return $this->Amount;
  }
}
```

Response: App\Soap\Response\GetConversionAmountResponse

```php
<?php

namespace App\Soap\Response;

class GetConversionAmountResponse
{
  /**
   * @var string
   */
  protected $GetConversionAmountResult;

  /**
   * GetConversionAmountResponse constructor.
   *
   * @param string
   */
  public function __construct($GetConversionAmountResult)
  {
    $this->GetConversionAmountResult = $GetConversionAmountResult;
  }

  /**
   * @return string
   */
  public function getGetConversionAmountResult()
  {
    return $this->GetConversionAmountResult;
  }
}
```
