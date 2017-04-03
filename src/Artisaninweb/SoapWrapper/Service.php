<?php

namespace Artisaninweb\SoapWrapper;

use SoapClient;
use SoapHeader;

class Service
{
  /**
   * @var SoapClient
   */
  protected $client;

  /**
   * @var string
   */
  protected $wsdl;

  /**
   * @var boolean
   */
  protected $trace;

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
  protected $certificate;

  /**
   * @var array
   */
  protected $options;

  /**
   * @var array
   */
  protected $classmap;

  /**
   * Service constructor.
   */
  public function __construct()
  {
    $this->wsdl        = null;
    $this->client      = null;
    $this->certificate = false;
    $this->options     = [];
    $this->classmap    = [];
    $this->headers     = [];
  }

  /**
   * Set a custom client
   *
   * @param SoapClient $client
   *
   * @return $this
   */
  public function client(SoapClient $client)
  {
    $this->client = $client;

    return $this;
  }

  /**
   * Get the custom client
   *
   * @return SoapClient
   */
  public function getClient()
  {
    return $this->client;
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
   * @param array $classmap
   *
   * @return $this
   */
  public function classMap(array $classmap)
  {
    $this->classmap = $classmap;

    return $this;
  }

  /**
   * Get the classmap
   *
   * @return array
   */
  public function getClassmap()
  {
    $classmap = $this->classmap;
    $classes  = [] ;

    if (!empty($classmap)) {
      foreach ($classmap as $class) {
        // Can't use end because of strict mode :(
        $name = current(array_slice(explode('\\', $class), -1, 1, true));

        $classes[$name] = $class;
      }
    }

    return $classes;
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
   * Get the extra options
   *
   * @return array
   */
  public function getOptions()
  {
    $options = [
      'trace'      => $this->getTrace(),
      'cache_wsdl' => $this->getCache(),
      'classmap'   => $this->getClassmap(),
    ];

    if ($this->certificate) {
      $options['local_cert'] = $this->certificate;
    }

    $this->options = array_merge($options, $this->options);

    return $this->options;
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
     * Get the headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
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
   * Set the Soap headers
   *
   * @param SoapHeader $header
   *
   * @return $this
   */
  public function customHeader($header)
  {
    $this->headers[] = $header;

    return $this;
  }
}
