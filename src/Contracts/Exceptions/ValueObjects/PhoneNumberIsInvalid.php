<?php

namespace Src\Contracts\Exception\ValueObjects;

use Src\Contracts\Exception\DomainException;

class PhoneNumberIsInvalid extends DomainException
{
    public function __construct(public $message = "Phone number is invalid")
    {
        parent::__construct($this->message);
    }
}
