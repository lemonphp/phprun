<?php

namespace Lemon\PHPRun\Provider;

use Pimple\ServiceProviderInterface;
use Pimple\Container;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Lemon\PHPRun\Type\Collection;

class AppServiceProvider implements ServiceProviderInterface, EventSubscriberInterface
{

    public function register(Container $pimple)
    {
        $pimple['tasks'] = function() {
            return new Collection();
        };
        $pimple['servers'] = function() {
            return new Collection();
        };
        $pimple['environments'] = function() {
            return new Collection();
        };
        $pimple['parameters'] = function() {
            return new Collection();
        };
        $pimple['scenarios'] = function() {
            return new Collection();
        };

        $pimple['stage_strategy'] = function(Container $container) {
            return new StageStrategy($container['servers'], $container['environments'], $container['parameters']);
        };
    }

    public static function getSubscribedEvents()
    {

    }
}