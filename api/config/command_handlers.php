<?php

use ApiSlimTemplate\Example\Application\ExampleCommandHandler;
use Psr\Container\ContainerInterface;

return static function (ContainerInterface $container) {
    return [
        $container->get(ExampleCommandHandler::class),
    ];
};