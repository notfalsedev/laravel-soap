<?php

namespace Artisaninweb\SoapWrapper\Extension;

use Artisaninweb\SoapWrapper\Service;
use Exception;

/**
 * Soap Webservice abstract model class
 *
 * @package Artisaninweb\SoapWrapper
 * @author  Michael van de Rijt
 */
abstract class SoapService extends Service {

    /**
     * @var string
     */
    protected $wsdl;

    /**
     * The constructor
     *
     * @throws Exception
     */
    public function __construct()
    {
        if(!empty($this->wsdl))
        {
            $this->wsdl($this->wsdl)
                 ->createClient();

            return;
        }
        throw new Exception("The variable 'wsdl' must be set.");
    }

}