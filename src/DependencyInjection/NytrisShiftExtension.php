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

namespace Nytris\SymfonyPlugin\Shift\DependencyInjection;

use Exception;
use Nytris\SymfonyPlugin\Shift\Package\Initialiser;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\DirectoryLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class NytrisShiftExtension.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class NytrisShiftExtension extends Extension
{
    /**
     * @inheritdoc
     *
     * @param array<mixed> $configs
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Import common configuration.
        $fileLocator = new FileLocator(__DIR__ . '/../Resources/config');
        $loader = new DirectoryLoader($container, $fileLocator);
        $yamlFileLoader = new YamlFileLoader($container, $fileLocator);
        $loader->setResolver(new LoaderResolver([
            $yamlFileLoader,
            $loader,
        ]));
        $loader->load('services/');

        // Configure PHP Code Shift.
        $loggerConfig = $config['logger'] ?? [];
        $loggerServiceId = $loggerConfig['service'] ?? null;
        $loggerChannel = $loggerConfig['channel'] ?? null;

        $initialiserDefinition = $container->findDefinition(Initialiser::class);

        if ($loggerServiceId !== null) {
            $initialiserDefinition->setArgument(0, new Reference($loggerServiceId));
        }

        if ($loggerChannel !== null) {
            $initialiserDefinition->addTag('monolog.logger', ['channel' => $loggerChannel]);
        }
    }
}
