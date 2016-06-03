<?php

namespace Lemon\PHPRun\Console;

use Pimple\Container;
use Symfony\Component\Console\Application as BaseApplication;

/**
 * Class ContainerAwareApplication
 *
 * Console application be able setted and getted container
 */
class Application extends BaseApplication
{
    /**
     * @var \Pimple\Container
     */
    protected $container;

    /**
     * Sets a pimple instance onto this application.
     *
     * @param \Pimple\Container $container
     *
     * @return void
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Get the Container.
     *
     * @return \Pimple\Container
     */
    public function getContainer()
    {
        return $this->container;
    }
}