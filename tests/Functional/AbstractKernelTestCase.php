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

namespace Nytris\SymfonyPlugin\Shift\Tests\Functional;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AbstractKernelTestCase.
 *
 * Base class for all kernel test cases.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
abstract class AbstractKernelTestCase extends KernelTestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * Dispatches the console.command event that is hooked to install the PSR logger.
     */
    public function dispatchConsoleCommandEvent(): void
    {
        $command = mock(Command::class, [
            'getApplication' => mock(Application::class),
        ]);
        $input = mock(InputInterface::class);
        $output = mock(OutputInterface::class);

        static::getContainer()->get('event_dispatcher')
            ->dispatch(
                new ConsoleCommandEvent($command, $input, $output),
                ConsoleEvents::COMMAND
            );

    }
}
