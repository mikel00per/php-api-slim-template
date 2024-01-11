<?php

declare(strict_types=1);

namespace ApiSlimTemplate\Example\Infrastructure\Controllers;

use ApiSlimTemplate\Example\Application\ExampleCommand;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Shared\Domain\Bus\Command\CommandBus;
use Throwable;

final class GetExampleController
{
    public function __construct(private CommandBus $bus) {}

    /**
     * @throws Throwable
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $command = new ExampleCommand(1, 'example');
        $this->bus->dispatch($command);

        return $response->withStatus(StatusCodeInterface::STATUS_OK);
    }
}
