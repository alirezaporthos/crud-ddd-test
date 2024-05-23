<?php

namespace Src\Name\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\IntValue;

class CustomerId extends IntValue
{
    public function __construct(?int $value = null, int $min = 0)
    {
        parent::__construct($value, $min);
    }
}
