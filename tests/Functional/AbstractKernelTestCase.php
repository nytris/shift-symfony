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
}
