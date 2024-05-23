<?php

namespace Src\Name\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\EmailValue;

class CustomerEmail extends EmailValue
{
    public function __construct(string $address = null)
    {
        parent::__construct($address);
    }
}
