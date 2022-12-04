<?php

declare(strict_types=1);

use Microservices\Http\MicroserviceSlimInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteCollectorProxy;

return static function (MicroserviceSlimInterface $microservice) {
    $microservice->group('/api', function (RouteCollectorProxy $microservice) {
        $microservice->get('', function (ServerRequestInterface $request, ResponseInterface $response) {
            $response->getBody()->write('hi');
            return $response;
        });
    });
};
