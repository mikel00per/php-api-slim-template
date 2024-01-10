<?php

declare(strict_types=1);

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Shared\Infrastructure\DependencyInjection\ContainerFactory;
use Shared\Infrastructure\DependencyInjection\File;
use Shared\Infrastructure\Slim\MicroserviceSlimInterface;

require __DIR__ . '/../vendor/autoload.php';

try {
    $settings = File::require(__DIR__ . '/settings.php');
    return ContainerFactory::create($settings)->get(MicroserviceSlimInterface::class);
} catch (NotFoundExceptionInterface|ContainerExceptionInterface|Exception $e) {
    throw new RuntimeException($e->getMessage(), 100, $e);
}
