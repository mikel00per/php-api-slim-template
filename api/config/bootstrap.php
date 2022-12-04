<?php

declare(strict_types=1);

use ContainerSettings\ContainerFactory;
use Microservices\Http\MicroserviceSlimInterface;

require __DIR__ . '/../vendor/autoload.php';

try {
    return ContainerFactory::buildContainer(__DIR__ . '/settings.php')
        ->get(MicroserviceSlimInterface::class);
} catch (Exception $e) {
    throw new RuntimeException($e->getMessage(), 100, $e);
}
