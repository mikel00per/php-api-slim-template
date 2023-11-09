<?php

declare(strict_types=1);

use ApiSlimTemplate\Example\Infrastructure\Controllers\GetExampleController;
use Shared\Infrastructure\Slim\MicroserviceSlimInterface;
use Slim\Routing\RouteCollectorProxy;

return static function (MicroserviceSlimInterface $microservice) {
    $microservice->group('/api', function (RouteCollectorProxy $microservice) {
        $microservice->get('/example', GetExampleController::class);
    });
};
