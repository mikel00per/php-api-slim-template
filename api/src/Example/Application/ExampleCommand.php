<?php

declare(strict_types=1);

namespace ApiSlimTemplate\Example\Application;

use Shared\Domain\Bus\Command\Command;

final class ExampleCommand implements Command
{
    public function __construct(private int $id, private string $value) {}

    public function id(): int
    {
        return $this->id;
    }

    public function value(): string
    {
        return $this->value;
    }
}
