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
    protected $name;

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
        if(!empty($this->name) && !empty($this->wsdl))
        {
            $this->name($this->name);
            $this->wsdl($this->wsdl);

            return;
        }
        throw new Exception("The variables 'name' and 'wsdl' must be set.");
    }

}