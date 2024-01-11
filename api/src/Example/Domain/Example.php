<?php

declare(strict_types=1);

namespace ApiSlimTemplate\Example\Domain;

use Shared\Domain\ValueObjects\IntValueObject;
use Shared\Domain\ValueObjects\StringValueObject;

final readonly class Example
{
    public function __construct(private IntValueObject $id, private StringValueObject $value) {}

    public static function create(IntValueObject $id, StringValueObject $value): self
    {
        return new self($id, $value);
    }
}
