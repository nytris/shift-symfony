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

use Asmblah\PhpCodeShift\Shift;
use Asmblah\PhpCodeShift\ShiftPackage;
use Nytris\Boot\BootConfig;
use Nytris\Boot\PlatformConfig;
use Nytris\Bundle\Plugin\PluginRepository;
use Nytris\Nytris;
use Nytris\SymfonyPlugin\Shift\Plugin;

require_once __DIR__ . '/../vendor/autoload.php';

Mockery::getConfiguration()->allowMockingNonExistentMethods(false);
Mockery::globalHelpers();

// Shift must first be uninstalled from its standalone mode before being installed
// outside of nytris.config.php as we need to do here during PHPUnit bootstrap.
Shift::uninstall();

$bootConfig = new BootConfig(new PlatformConfig(dirname(__DIR__) . '/var/nytris/'));
$bootConfig->installPackage(new ShiftPackage());
Nytris::boot($bootConfig);

PluginRepository::installPlugin(new Plugin());
