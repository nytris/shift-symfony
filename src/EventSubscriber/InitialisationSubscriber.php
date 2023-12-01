<?php

/*
 * Nytris Shift Symfony - Integrates PHP Code Shift into a Symfony application.
 * Copyright (c) Dan Phillimore (asmblah)
 * https://github.com/nytris/shift-symfony/
 *
 * Released under the MIT license.
 * https://github.com/nytris/shift-symfony/raw/main/MIT-LICENSE.txt
 */

declare(strict_types=1);

namespace Nytris\SymfonyPlugin\Shift\EventSubscriber;

use Nytris\SymfonyPlugin\Shift\Package\InitialiserInterface;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class InitialisationSubscriber.
 *
 * Initialises PHP Code Shift when a Symfony console command or web request executes.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class InitialisationSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly InitialiserInterface $initialiser
    ) {
    }

    /**
     * @inheritDoc
     *
     * @return array<mixed>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            ConsoleEvents::COMMAND => 'onInitialise',
            KernelEvents::REQUEST => 'onInitialise',
        ];
    }

    /**
     * Event subscriber callback.
     */
    public function onInitialise(): void
    {
        $this->initialiser->initialise();
    }
}
