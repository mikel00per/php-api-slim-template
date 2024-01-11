<?php

declare(strict_types=1);

namespace ApiSlimTemplate\Example\Application;

use ApiSlimTemplate\Example\Domain\Example;
use Shared\Domain\ValueObjects\IntValueObject;
use Shared\Domain\ValueObjects\StringValueObject;

final class ExampleCreator
{
    public function __construct() {}

    public function __invoke(IntValueObject $id, StringValueObject $value): Example
    {
        return Example::create($id, $value);
    }
}
