<?php

namespace Artisaninweb\SoapWrapper;

use SoapClient;
use Artisaninweb\SoapWrapper\Contracts\SoapClientDecorator as SoapClientDecoratorContract;

class SoapClientDecorator implements SoapClientDecoratorContract
{

    /**
     * @param string|SoapClient $wsdl
     * @param null|array $options
     * @param array $headers
     * @throws \SoapFault
     */
    public function __construct($wsdl, $options = null, array $headers = [])
    {
        if ($wsdl instanceof SoapClient) {
            $this->client = $wsdl;
        } else {
            $this->client = new SoapClient($wsdl, $options);
        }

        if (!empty($headers)) {
            $this->client->__setSoapHeaders($headers);
        }
    }

    public function getFunctions()
    {
        return $this->client->__getFunctions();
    }

    public function getLastRequest()
    {
        return $this->client->__getLastRequest();
    }

    public function getLastResponse()
    {
        return $this->client->__getLastResponse();
    }

    public function getLastRequestHeaders()
    {
        return $this->client->__getLastRequestHeaders();
    }

    public function getLastResponseHeaders()
    {
        return $this->client->__getLastResponseHeaders();
    }

    public function getTypes()
    {
        return $this->client->__getTypes();
    }

    public function getCookies()
    {
        return $this->client->__getCookies();
    }

    public function cookie($name, $value)
    {
        $this->client->__setCookie($name, $value);

        return $this;
    }

    public function location($location = '')
    {
        $this->client->__setLocation($location);

        return $this;
    }

    public function doRequest($request, $location, $action, $version, $one_way)
    {
        return $this->client->__doRequest($request, $location, $action, $version, $one_way);
    }

    public function call($function, $params)
    {
        return call_user_func_array([$this, $function], $params);
    }

    public function SoapCall(
        $function,
        array $params,
        array $options = null,
        $inputHeader = null,
        &$outputHeaders = null
    ) {
        return $this->client->__soapCall($function, $params, $options, $inputHeader, $outputHeaders);
    }
}
