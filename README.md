# Nytris Shift Symfony plugin

[![Build Status](https://github.com/nytris/shift-symfony/workflows/CI/badge.svg)](https://github.com/nytris/shift-symfony/actions?query=workflow%3ACI)

Integrates [PHP Code Shift][PHP Code Shift] into a Symfony application.

## Usage

Install via Composer:
```shell
$ composer install nytris/shift-symfony
```

### Configuring platform boot config

`nytris.config.php`

```php
<?php

declare(strict_types=1);

use Asmblah\PhpCodeShift\ShiftPackage;
use Nytris\Boot\BootConfig;
use Nytris\Boot\PlatformConfig;

$bootConfig = new BootConfig(new PlatformConfig(__DIR__ . '/var/cache/nytris/'));

$bootConfig->installPackage(new ShiftPackage([...]));

return $bootConfig;
```

[PHP Code Shift]: https://github.com/asmblah/php-code-shift
