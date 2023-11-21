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

namespace Nytris\SymfonyPlugin\Shift\Cache;

use Asmblah\PhpCodeShift\ShiftInterface;
use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;

/**
 * Class CacheClearer.
 *
 * Clears the PHP Code Shift cache as part of the Symfony cache clear.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class CacheClearer implements CacheClearerInterface
{
    public function __construct(
        private readonly ShiftInterface $shift
    ) {
    }

    /**
     * @inheritDoc
     */
    public function clear(string $cacheDir): void
    {
        $this->shift->getCache()->clear();
    }
}
