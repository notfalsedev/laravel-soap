<?php

namespace Artisaninweb\SoapWrapper;

/**
 * @method static SoapWrapper add(string $name, \Closure $closure) Add a new service to the wrapper
 * @method static void addByArray(array $services) Add services by array
 * @method static mixed client(string $name, \Closure $closure) Get the client
 * @method static mixed call(string $call, array $data, array $options) A easy access call method
 * @method static bool has(string $name) Check if wrapper has service
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return SoapWrapper::class;
    }
}
