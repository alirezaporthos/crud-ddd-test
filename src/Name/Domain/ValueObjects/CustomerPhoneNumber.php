<?php

namespace Src\Name\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\PhoneNumberValue;

class CustomerPhoneNumber extends PhoneNumberValue
{
    public function __construct(?string $value, ?string $type = "IR")
    {
        parent::__construct($value, $type);
    }
}
