<?php

declare(strict_types=1);

use Shared\Infrastructure\DependencyInjection\ContainerFactory;
use Shared\Infrastructure\Slim\MicroserviceSlimInterface;

require __DIR__ . '/../vendor/autoload.php';

try {
    return ContainerFactory::buildContainer(__DIR__ . '/settings.php')
        ->get(MicroserviceSlimInterface::class);
} catch (Exception $e) {
    throw new RuntimeException($e->getMessage(), 100, $e);
}
