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
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;

/**
 * Class CacheWarmer.
 *
 * Warms the PHP Code Shift cache as part of the Symfony cache warmup.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class CacheWarmer implements CacheWarmerInterface
{
    public function __construct(
        private readonly ShiftInterface $shift
    ) {
    }

    /**
     * @inheritDoc
     */
    public function isOptional(): bool
    {
        return true; // Shifted code cache can be warmed incrementally/on-demand.
    }

    /**
     * @inheritDoc
     */
    public function warmUp(string $cacheDir): array
    {
        $this->shift->getCache()->warmUp();

        return []; // TODO: Specify any applicable paths within PHP Code Shift that we want to preload.
    }
}
