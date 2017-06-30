<?php

namespace Lemon\PHPRun;

use Lemon\PHPRun\Server\Environment;
use Lemon\PHPRun\Server\Configuration;
use Lemon\PHPRun\Server\Builder;
use Lemon\PHPRun\Server\Local;
use Lemon\PHPRun\PHPRun;

function set($key, $value)
{
    PHPRun::get()->parameters->set($key, $value);
}

function get($key, $default = null)
{
    try {
        return PHPRun::get()->parameters->get($key);
    } catch (\RuntimeException $e) {
        return $default;
    }
}

function env($key = null, $value = null)
{

}

function task($name, $callback)
{

}

function server($name, $host, $port = 22)
{
    $runner = PHPRun::get();
    $env = new Environment();
    $config = new Configuration($name, $host, $port);

    $server = new Local();

    $runner->servers->set($name, $server);
    $runner->environments->set($name, $env);

    return new Builder($config, $env);
}

function localServer($name)
{
    
}
