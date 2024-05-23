<?php

namespace Src\Name\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\DateTimeValue;

class CustomerDateofBirth extends DateTimeValue
{
    public function __construct(?string $dateTimeValue)
    {
        parent::__construct($dateTimeValue);
    }
}
