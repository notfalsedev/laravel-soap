<?php

namespace Artisaninweb\SoapWrapper;

use SoapClient;
use SoapHeader;

/**
 * Soap Webservice class
 *
 * @package Artisaninweb\SoapWrapper
 * @author  Michael van de Rijt
 */
class Service {

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $wsdl;

    /**
     * @var resource
     */
    protected $client;

    /**
     * @var array
     */
    protected $header;

    /**
     * Set the name of the service
     *
     * @param $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the name of the service
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the wsdl of the service
     *
     * @param $wsdl
     * @return $this
     */
    public function wsdl($wsdl)
    {
        $this->wsdl = $wsdl;

        return $this->createClient();
    }

    /**
     * Get the wsdl from the service
     *
     * @return string
     */
    public function getWsdl()
    {
        return $this->wsdl;
    }

    /**
     * Do a soap call on the webservice client
     *
     * @param $function
     * @param $params
     * @return mixed
     */
    public function call($function,$params)
    {
        return $this->client->{$function}($params);
    }

    /**
     * Allias to do a soap call on the webservice client
     *
     * @param $function
     * @param $params
     * @return mixed
     */
    public function SoapCall($function,$params)
    {
        return $this->call($function,$params);
    }

    /**
     * Do soap request
     *
     * @param $request
     * @param $location
     * @param $action
     * @param $version
     * @param $one_way
     * @return mixed
     */
    public function doRequest($request,$location,$action,$version,$one_way)
    {
        return $this->client->__doRequest($request, $location, $action, $version, $one_way);
    }

    /**
     * Get all functions from the service
     *
     * @return mixed
     */
    public function getFunctions()
    {
        return $this->client->__getFunctions();
    }

    /**
     * Get the last request
     *
     * @return mixed
     */
    public function getLastRequest()
    {
        return $this->client->__getLastRequest();
    }

    /**
     * Get the last response
     *
     * @return mixed
     */
    public function getLastResponse()
    {
        return $this->client->__getLastResponse();
    }

    /**
     * Get the last response headers
     *
     * @return mixed
     */
    public function getLastResponseHeaders()
    {
        return $this->client->__getLastRequestHeaders();
    }

    /**
     * Get the types
     *
     * @return mixed
     */
    public function getTypes()
    {
        return $this->client->__getTypes();
    }

    /**
     * Get all the set cookies
     *
     * @return mixed
     */
    public function getCookies()
    {
        return $this->client->__cookies;
    }

    /**
     * Set a new cookie
     *
     * @param $name
     * @param $value
     * @return $this
     */
    public function setCookie($name,$value)
    {
        $this->client->__setCookie($name,$value);

        return $this;
    }

    /**
     * Set the location
     *
     * @param string $location
     * @return $this
     */
    public function setLocation($location='')
    {
        $this->client->__setLocation($location);

        return $this;
    }

    /**
     * Create a new SoapHeader
     *
     * @param      $namespace
     * @param      $name
     * @param null $data
     * @param bool $mustunderstand
     * @param null $actor
     * @return $this
     */
    public function header($namespace,$name,$data=null,$mustunderstand=false,$actor=null)
    {
       $this->header[] = new SoapHeader($namespace,$name,$data,$mustunderstand,$actor);

        return $this;
    }

    /**
     * Set the Soap headers
     *
     * @return $this
     */
    public function setSoapHeaders()
    {
        $this->client->__setSoapHeaders($this->headers);

        return $this;
    }

    /**
     * Create the Soap client
     *
     * @return $this
     */
    protected function createClient()
    {
        $this->client = new SoapClient($this->getWsdl());

        return $this;
    }

}