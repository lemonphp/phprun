<?php

namespace Lemon\PHPRun\Event;

use Symfony\Component\EventDispatcher\Event as BaseEvent;

class Event extends BaseEvent
{
    const APP_RUN = 'app-run';

}