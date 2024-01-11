<?php

declare(strict_types=1);

namespace ApiSlimTemplate\Example\Application;

use Shared\Domain\Bus\Command\CommandHandler;
use Shared\Domain\ValueObjects\IntValueObject;
use Shared\Domain\ValueObjects\StringValueObject;

final readonly class ExampleCommandHandler implements CommandHandler
{
    public function __construct(private ExampleCreator $creator) {}

    public function __invoke(ExampleCommand $command): void
    {
        $id = new IntValueObject($command->id());
        $value = new StringValueObject($command->value());

        ($this->creator)($id, $value);
    }
}
