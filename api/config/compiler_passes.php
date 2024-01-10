<?php

use Shared\Domain\Bus\Command\CommandHandler;
use Shared\Domain\Bus\Event\DomainEvent;
use Shared\Domain\Bus\Query\QueryHandler;
use Shared\Infrastructure\DependencyInjection\CommandHandlersCompilerPass;
use Shared\Infrastructure\DependencyInjection\DomainEventSubscribersHandlersCompilerPass;
use Shared\Infrastructure\DependencyInjection\QueryHandlersCompilerPass;

return [
    new CommandHandlersCompilerPass(),
    new QueryHandlersCompilerPass(),
    new DomainEventSubscribersHandlersCompilerPass(),
];
