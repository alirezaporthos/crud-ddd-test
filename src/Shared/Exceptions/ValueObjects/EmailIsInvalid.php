<?php

namespace Src\Shared\Exceptions\ValueObjects;

use Src\Shared\Exceptions\DomainException;

class EmailIsInvalid extends DomainException
{
    public function __construct(public $message = "Email is invalid")
    {
        parent::__construct($this->message);
    }
}
