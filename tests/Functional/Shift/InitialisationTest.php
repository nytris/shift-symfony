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

namespace Nytris\SymfonyPlugin\Shift\Tests\Functional\Shift;

use Asmblah\PhpCodeShift\Shift;
use Asmblah\PhpCodeShift\ShiftInterface;
use Nytris\SymfonyPlugin\Shift\Tests\Functional\AbstractKernelTestCase;
use Nytris\SymfonyPlugin\Shift\Tests\Functional\Util\TestLogger;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Class InitialisationTest.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class InitialisationTest extends AbstractKernelTestCase
{
    private ShiftInterface $shift;

    public function setUp(): void
    {
        $this->shift = new Shift();
    }

    public function testLoggerIsNotChangedOnReboot(): void
    {
        static::bootKernel(['environment' => 'explicit_logger']);
        $this->dispatchConsoleCommandEvent();
        $logger = $this->shift->getLogger();
        /** @var Kernel $kernel */
        $kernel = static::$kernel;

        $kernel->reboot(null);

        static::assertSame($logger, $this->shift->getLogger());
        static::assertInstanceOf(TestLogger::class, $logger);
    }
}
