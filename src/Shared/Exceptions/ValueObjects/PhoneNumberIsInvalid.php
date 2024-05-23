<?php

namespace Src\Shared\Exceptions\ValueObjects;

use Src\Shared\Exceptions\DomainException;

class PhoneNumberIsInvalid extends DomainException
{
    public function __construct(public $message = "Phone number is invalid")
    {
        parent::__construct($this->message);
    }
}
