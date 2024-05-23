<?php

namespace Src\Name\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\StringValue;

class CustomerFirstName extends StringValue
{
    public function __construct(?string $value, ?int $limit = 1000)
    {
        parent::__construct($value, $limit);
    }
}
