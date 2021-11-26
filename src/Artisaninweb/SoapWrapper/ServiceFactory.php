<?php

namespace Artisaninweb\SoapWrapper;

class ServiceFactory implements Contracts\ServiceFactory
{

    public function createNew()
    {
        return new Service();
    }
}
