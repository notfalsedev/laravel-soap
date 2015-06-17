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
class Service
{

  /**
   * @var string
   */
  protected $name;

  /**
   * @var string
   */
  protected $wsdl;

  /**
   * @var boolean
   */
  protected $trace;

  /**
   * @var resource
   */
  protected $client;

  /**
   * @var array
   */
  protected $headers;

  /**
   * @var string
   */
  protected $cache;

  /**
   * @var bool
   */
  protected $certificate = false;

  /**
   * @var array
   */
  protected $options = [];

  /**
   * Set the name of the service
   *
   * @param string $name
   *
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
   * Set trace option - enables tracing of request
   *
   * @param boolean $trace
   *
   * @return $this
   */
  public function trace($trace)
  {
    $this->trace = $trace;

    return $this;
  }

  /**
   * Get the trace option
   *
   * @return boolean
   */
  public function getTrace()
  {
    return $this->trace;
  }

  /**
   * Set the WSDL cache
   *
   * @param $cache
   *
   * @return $this
   */
  public function cache($cache)
  {
    $this->cache = $cache;

    return $this;
  }

  /**
   * Get the WSDL cache
   *
   * @return string
   */
  public function getCache()
  {
    return $this->cache;
  }

  /**
   * Set the extra options on the SoapClient
   *
   * @param array $options
   *
   * @return $this
   */
  public function options(array $options)
  {
    $this->options = $options;

    return $this;
  }

  /**
   * Set the certificate location
   *
   * @param string $certificate
   *
   * @return $this
   */
  public function certificate($certificate)
  {
    if ($certificate) {
      $this->certificate = $certificate;
    }

    return $this;
  }

  /**
   * Get the extra options
   *
   * @return array
   */
  public function getOptions()
  {
    $options = [
      'trace'      => $this->getTrace(),
      'cache_wsdl' => $this->getCache()
    ];

    if ($this->certificate) {
      $options['local_cert'] = $this->certificate;
    }

    $this->options = array_merge($options, $this->options);

    return $this->options;
  }

  /**
   * Set the wsdl of the service
   *
   * @param string $wsdl
   *
   * @return $this
   */
  public function wsdl($wsdl)
  {
    $this->wsdl = $wsdl;

    return $this;
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
   * @param string $function
   * @param array  $params
   *
   * @return mixed
   */
  public function call($function, $params)
  {
    if (!empty($this->headers)) {
      $this->setSoapHeaders();
    }

    return call_user_func_array([$this->client, $function], $params);
  }

  /**
   * Allias to do a soap call on the webservice client
   *
   * @param string $function
   * @param array  $params
   *
   * @return mixed
   */
  public function SoapCall($function, $params)
  {
    return $this->call($function, $params);
  }

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
  public function doRequest($request, $location, $action, $version, $one_way)
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
   * Get the last request headers
   *
   * @return mixed
   */
  public function getLastRequestHeaders()
  {
    return $this->client->__getLastRequestHeaders();
  }

  /**
   * Get the last response headers
   *
   * @return mixed
   */
  public function getLastResponseHeaders()
  {
    return $this->client->__getLastResponseHeaders();
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
   * @param string $name
   * @param string $value
   *
   * @return $this
   */
  public function cookie($name, $value)
  {
    $this->client->__setCookie($name, $value);

    return $this;
  }

  /**
   * Set the location
   *
   * @param string $location
   *
   * @return $this
   */
  public function location($location = '')
  {
    $this->client->__setLocation($location);

    return $this;
  }

  /**
   * Create the Soap client
   *
   * @return $this
   */
  public function createClient()
  {
    $this->client = new SoapClient($this->getWsdl(), $this->getOptions());

    return $this;
  }

  /**
   * Create a new SoapHeader
   *
   * @param string $namespace
   * @param string $name
   * @param null   $data
   * @param bool   $mustUnderstand
   * @param null   $actor
   *
   * @return $this
   */
  public function header($namespace, $name, $data = null, $mustUnderstand = false, $actor = null)
  {
    if ($actor) {
      $this->headers[] = new SoapHeader($namespace, $name, $data, $mustUnderstand, $actor);
    } else {
      $this->headers[] = new SoapHeader($namespace, $name, $data, $mustUnderstand);
    }

    return $this;
  }

  /**
   * @param SoapHeader $header
   *
   * @return $this
   */
  public function customHeader($header)
  {
    $this->headers[] = $header;
    return $this;
  }

  /**
   * Set the Soap headers
   *
   * @return $this
   */
  protected function setSoapHeaders()
  {
    $this->client->__setSoapHeaders($this->headers);

    return $this;
  }

}
