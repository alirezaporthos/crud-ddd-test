<?php

namespace Src\Shared\Exceptions\ValueObjects;

use Src\Shared\Exceptions\DomainException;

class NumberIsLessThanMinException extends DomainException
{
    public function __construct(public $message = "Number is less than min value", public $min = 1000)
    {
        parent::__construct($this->message);
    }
}
