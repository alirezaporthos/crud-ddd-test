<?php

namespace Src\Shared\Exceptions\ValueObjects;

use Src\Shared\Exceptions\DomainException;

class DateTimeIsInvalid extends DomainException
{
    public function __construct(public $message = "Datetime format is invalid")
    {
        parent::__construct($this->message);
    }
}
