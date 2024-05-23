<?php

namespace Src\Shared\Exceptions\ValueObjects;

use Src\Shared\Exceptions\DomainException;

class NumberIsMoreThanMaxException extends DomainException
{
    public function __construct(public $message = "Number is more than max value", public $max = 1000)
    {
        parent::__construct($this->message);
    }
}
