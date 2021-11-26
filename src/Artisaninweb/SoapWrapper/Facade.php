<?php

namespace Artisaninweb\SoapWrapper;

use Artisaninweb\SoapWrapper\Contracts\SoapWrapper;

class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return SoapWrapper::class;
    }
}
