<?php

declare(strict_types=1);

use Monolog\Processor\UidProcessor;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Log\LoggerInterface;
use Shared\Domain\Bus\Command\CommandBus;
use Shared\Infrastructure\Bus\Command\InMemorySymfonyCommandBus;
use Shared\Infrastructure\Settings\SettingsInterface;
use Shared\Infrastructure\Slim\Handlers\HttpErrorHandler;
use Shared\Infrastructure\Slim\Loggers\LoggerFactory;
use Shared\Infrastructure\Slim\MicroserviceSlim;
use Shared\Infrastructure\Slim\MicroserviceSlimInterface;
use Slim\Middleware\ErrorMiddleware;

return [
    MicroserviceSlimInterface::class => static function (ContainerInterface $container) {
        $settings = $container->get(SettingsInterface::class);

        $microservice = new MicroserviceSlim($container);

        // Register routes
        (require $settings->get('router.definition'))($microservice);

        // Register middleware
        (require $settings->get('middlewares.definition'))($microservice);

        return $microservice;
    },
    // HTTP factories
    ResponseFactoryInterface::class => static function (ContainerInterface $container) {
        return $container->get(Psr17Factory::class);
    },
    ServerRequestFactoryInterface::class => static function (ContainerInterface $container) {
        return $container->get(Psr17Factory::class);
    },
    StreamFactoryInterface::class => static function (ContainerInterface $container) {
        return $container->get(Psr17Factory::class);
    },
    UploadedFileFactoryInterface::class => static function (ContainerInterface $container) {
        return $container->get(Psr17Factory::class);
    },
    UriFactoryInterface::class => static function (ContainerInterface $container) {
        return $container->get(Psr17Factory::class);
    },
    // The logger factory
    LoggerInterface::class => static function (ContainerInterface $container) {
        $settings = $container->get(SettingsInterface::class);

        $name = $settings->get('logger.name');
        $path = $settings->get('logger.path');
        $fileName = $settings->get('logger.filename');
        $level = $settings->get('logger.level');

        return (new LoggerFactory($path, $level))
            ->addProcessor(new UidProcessor())
            ->addFileHandler($fileName, $level)
            //->addConsoleHandler($level)
            ->createLogger($name);
    },
    ErrorMiddleware::class => static function (ContainerInterface $container) {
        $settings = $container->get(SettingsInterface::class);
        $microservice = $container->get(MicroserviceSlimInterface::class);
        $logger = $container->get(LoggerInterface::class);

        $errorMiddleware = new ErrorMiddleware(
            $microservice->getCallableResolver(),
            $microservice->getResponseFactory(),
            $settings->get('error_middleware.display_details'),
            $settings->get('error_middleware.log_errors'),
            $settings->get('error_middleware.log_details'),
            $logger
        );

        $httpErrorHandler = $container->get(HttpErrorHandler::class);

        $errorMiddleware->setDefaultErrorHandler($httpErrorHandler);

        return $errorMiddleware;
    },
    CommandBus::class => static function (ContainerInterface $container) {
        $settings = $container->get(SettingsInterface::class);

        // This can be more simple using Symfony the handlers should be an array of instance objects.
        $commandHandlers = (require $settings->get('command_handlers.definition'))($container);

        return new InMemorySymfonyCommandBus($commandHandlers);
    }
];
