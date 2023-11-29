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
use Symfony\Bridge\Monolog\Logger as MonologLogger;

/**
 * Class ConfigurationTest.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class ConfigurationTest extends AbstractKernelTestCase
{
    private ShiftInterface $shift;

    public function setUp(): void
    {
        $this->shift = new Shift();
    }

    public function testLoggerIsSetWhenConfigured(): void
    {
        static::bootKernel(['environment' => 'explicit_logger']);

        static::assertInstanceOf(TestLogger::class, $this->shift->getLogger());
    }

    public function testChannelIsSetWhenConfigured(): void
    {
        static::bootKernel(['environment' => 'explicit_channel']);

        $logger = $this->shift->getLogger();

        static::assertInstanceOf(MonologLogger::class, $logger);
        static::assertSame('my_channel', $logger->getName());
    }

    public function testDefaultMonologLoggerIsUsedWhenNotConfigured(): void
    {
        static::bootKernel(['environment' => 'not_configured']);

        static::assertInstanceOf(MonologLogger::class, $this->shift->getLogger());
    }
}
