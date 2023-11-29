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

namespace Nytris\SymfonyPlugin\Shift\Package;

use Asmblah\PhpCodeShift\ShiftInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Initialiser.
 *
 * Initialises PHP Code Shift.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class Initialiser implements InitialiserInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly ShiftInterface $shift
    ) {
    }

    /**
     * @inheritDoc
     */
    public function initialise(): void
    {
        $this->shift->setLogger($this->logger);
    }
}
