<?php

namespace Artisaninweb\SoapWrapper;

use SoapClient;

class Client extends SoapClient
{
  /**
   * @var string
   */
  protected $wsdl;

  /**
   * Client constructor.
   *
   * @param string $wsdl
   * @param array  $options
   * @param array  $headers
   */
  public function __construct($wsdl, $options, array $headers = [])
  {
    parent::__construct($wsdl, $options);

    if (!empty($headers)) {
      $this->headers($headers);
    }
  }

  /**
   * Get all functions from the service
   *
   * @return mixed
   */
  public function getFunctions()
  {
    return $this->__getFunctions();
  }

  /**
   * Get the last request
   *
   * @return mixed
   */
  public function getLastRequest()
  {
    return $this->__getLastRequest();
  }

  /**
   * Get the last response
   *
   * @return mixed
   */
  public function getLastResponse()
  {
    return $this->__getLastResponse();
  }

  /**
   * Get the last request headers
   *
   * @return mixed
   */
  public function getLastRequestHeaders()
  {
    return $this->__getLastRequestHeaders();
  }

  /**
   * Get the last response headers
   *
   * @return mixed
   */
  public function getLastResponseHeaders()
  {
    return $this->__getLastResponseHeaders();
  }

  /**
   * Get the types
   *
   * @return mixed
   */
  public function getTypes()
  {
    return $this->__getTypes();
  }

  /**
   * Get all the set cookies
   *
   * @return mixed
   */
  public function getCookies()
  {
    return $this->__getCookies();
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
    $this->__setCookie($name, $value);

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
    $this->__setLocation($location);

    return $this;
  }

  /**
   * Set the Soap headers
   *
   * @param array $headers
   *
   * @return $this
   */
  protected function headers(array $headers = [])
  {
    $this->__setSoapHeaders($headers);

    return $this;
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
    return $this->__doRequest($request, $location, $action, $version, $one_way);
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
    return call_user_func_array([$this, $function], $params);
  }

  /**
   * Allias to do a soap call on the webservice client
   *
   * @param string $function
   * @param array  $params
   * @param array  $options
   * @param null   $inputHeader
   * @param null   $outputHeaders
   *
   * @return mixed
   */
  public function SoapCall($function,
    array $params,
    array $options = null,
    $inputHeader = null,
    &$outputHeaders = null
  ) {
    return $this->__soapCall($function, $params, $options, $inputHeader, $outputHeaders);
  }
}
