<?php

namespace Artisaninweb\SoapWrapper\Contracts;

use Artisaninweb\SoapWrapper\Contracts\SoapClientDecorator as SoapClientDecoratorContract;
use SoapHeader;

interface Service
{
    /**
     * Set a custom client
     *
     * @param SoapClientDecoratorContract $client
     *
     * @return Service
     */
    public function client(SoapClientDecoratorContract $client);

    /**
     * Get the custom client
     *
     * @return SoapClientDecoratorContract
     */
    public function getClient();

    /**
     * Set the wsdl of the service
     *
     * @param string $wsdl
     *
     * @return Service
     */
    public function wsdl($wsdl);

    /**
     * Get the wsdl from the service
     *
     * @return string
     */
    public function getWsdl();

    /**
     * Set trace option - enables tracing of request
     *
     * @param boolean $trace
     *
     * @return Service
     */
    public function trace($trace);

    /**
     * Get the trace option
     *
     * @return boolean
     */
    public function getTrace();

    /**
     * Set the WSDL cache
     *
     * @param $cache
     *
     * @return Service
     */
    public function cache($cache);

    /**
     * Get the WSDL cache
     *
     * @return string
     */
    public function getCache();

    /**
     * @param array $classmap
     *
     * @return Service
     */
    public function classMap(array $classmap);

    /**
     * Get the classmap
     *
     * @return array
     */
    public function getClassmap();

    /**
     * Set the extra options on the SoapClient
     *
     * @param array $options
     *
     * @return Service
     */
    public function options(array $options);

    /**
     * Get the extra options
     *
     * @return array
     */
    public function getOptions();

    /**
     * Set the certificate location
     *
     * @param string $certificate
     *
     * @return Service
     */
    public function certificate($certificate);

    /**
     * Get the headers
     *
     * @return array
     */
    public function getHeaders();

    /**
     * Create a new SoapHeader
     *
     * @param string $namespace
     * @param string $name
     * @param null $data
     * @param bool $mustUnderstand
     * @param null $actor
     *
     * @return Service
     */
    public function header($namespace, $name, $data = null, $mustUnderstand = false, $actor = null);

    /**
     * Set the Soap headers
     *
     * @param SoapHeader $header
     *
     * @return Service
     */
    public function customHeader($header);
}
