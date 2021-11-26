<?php

namespace Artisaninweb\SoapWrapper\Contracts;

use Artisaninweb\SoapWrapper\Exceptions\ServiceAlreadyExists;
use Artisaninweb\SoapWrapper\Exceptions\ServiceMethodNotExists;
use Artisaninweb\SoapWrapper\Exceptions\ServiceNotFound;
use Closure;

interface SoapWrapper
{
    /**
     * Add a new service to the wrapper
     *
     * @param string $name
     * @param Closure $closure
     *
     * @return SoapWrapper
     * @throws ServiceAlreadyExists
     */
    public function add($name, Closure $closure);

    /**
     * Add services by array
     *
     * @param array $services
     *
     * @return SoapWrapper
     *
     * @throws ServiceAlreadyExists
     * @throws ServiceMethodNotExists
     */
    public function addByArray(array $services = []);

    /**
     * Get the client
     *
     * @param string $name
     * @param Closure $closure
     *
     * @return mixed
     * @throws ServiceNotFound
     */
    public function client($name, Closure $closure = null);

    /**
     * A easy access call method
     *
     * @param string $call
     * @param array $data
     *
     * @return mixed
     */
    public function call($call, $data = [], $options = []);

    /**
     * Check if wrapper has service
     *
     * @param string $name
     *
     * @return bool
     */
    public function has($name);
}
