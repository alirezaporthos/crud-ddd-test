<?php

namespace Src\Contracts\Exception\ValueObject;

use Src\Contracts\Exception\DomainException;

class NumberIsMoreThanMaxException extends DomainException
{
    public function __construct(public $message = "Number is more than max value", public $max = 1000)
    {
        parent::__construct($this->message);
    }
}
