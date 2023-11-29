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

/**
 * Interface InitialiserInterface.
 *
 * Initialises PHP Code Shift.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
interface InitialiserInterface
{
    /**
     * Initialises PHP Code Shift.
     */
    public function initialise(): void;
}
