<?php

namespace Artisaninweb\SoapWrapper\Facades;

use Illuminate\Support\Facades\Facade;

class SoapWrapper extends Facade {

    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'SoapWrapper';
    }

}