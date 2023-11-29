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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 *
 * @author Dan Phillimore <dan@ovms.co>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        // Name must match alias generated from DI extension class NytrisShiftExtension.
        $treeBuilder = new TreeBuilder('nytris_shift');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('logger')
                    ->children()
                        ->scalarNode('service')->end()
                        ->scalarNode('channel')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
