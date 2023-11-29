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

namespace Nytris\SymfonyPlugin\Shift;

use Asmblah\PhpCodeShift\ShiftPackage;
use Nytris\Bundle\Plugin\PluginInterface;
use Nytris\SymfonyPlugin\Shift\DependencyInjection\NytrisShiftExtension;
use Nytris\SymfonyPlugin\Shift\Package\Initialiser;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Plugin.
 *
 * Integrates PHP Code Shift into Symfony.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class Plugin implements PluginInterface
{
    /**
     * @inheritDoc
     */
    public function boot(ContainerInterface $container): void
    {
        $initialiser = $container->get(Initialiser::class);

        $initialiser->initialise();
    }

    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container): void
    {
        $container->registerExtension(new NytrisShiftExtension());
    }

    /**
     * @inheritDoc
     */
    public function getPackageFqcn(): string
    {
        return ShiftPackage::class;
    }
}
