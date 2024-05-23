<?php

namespace Src\Contracts\Exception\ValueObject;

use Src\Contracts\Exception\DomainException;

class PhoneNumberIsInvalid extends DomainException
{
    public function __construct(public $message = "Phone number is invalid")
    {
        parent::__construct($this->message);
    }
}
