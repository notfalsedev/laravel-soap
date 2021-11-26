<?php

namespace Artisaninweb\SoapWrapper\Contracts;

interface SoapClientDecorator
{
    /**
     * Get all functions from the service
     *
     * @return mixed
     */
    public function getFunctions();

    /**
     * Get the last request
     *
     * @return mixed
     */
    public function getLastRequest();

    /**
     * Get the last response
     *
     * @return mixed
     */
    public function getLastResponse();

    /**
     * Get the last request headers
     *
     * @return mixed
     */
    public function getLastRequestHeaders();

    /**
     * Get the last response headers
     *
     * @return mixed
     */
    public function getLastResponseHeaders();

    /**
     * Get the types
     *
     * @return mixed
     */
    public function getTypes();

    /**
     * Get all the set cookies
     *
     * @return mixed
     */
    public function getCookies();

    /**
     * Set a new cookie
     *
     * @param string $name
     * @param string $value
     *
     * @return $this
     */
    public function cookie($name, $value);

    /**
     * Set the location
     *
     * @param string $location
     *
     * @return $this
     */
    public function location($location = '');

    /**
     * Do soap request
     *
     * @param string $request
     * @param string $location
     * @param string $action
     * @param string $version
     * @param string $one_way
     *
     * @return mixed
     */
    public function doRequest($request, $location, $action, $version, $one_way);

    /**
     * Do a soap call on the webservice client
     *
     * @param string $function
     * @param array $params
     *
     * @return mixed
     */
    public function call($function, $params);

    /**
     * Allias to do a soap call on the webservice client
     *
     * @param string $function
     * @param array $params
     * @param array $options
     * @param null $inputHeader
     * @param null $outputHeaders
     *
     * @return mixed
     */
    public function SoapCall(
        $function,
        array $params,
        array $options = null,
        $inputHeader = null,
        &$outputHeaders = null
    );
}
