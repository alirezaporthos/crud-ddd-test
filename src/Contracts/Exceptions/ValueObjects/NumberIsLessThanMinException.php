<?php

namespace Src\Contracts\Exception\ValueObjects;

use Src\Contracts\Exception\DomainException;

class NumberIsLessThanMinException extends DomainException
{
    public function __construct(public $message = "Number is less than min value", public $min = 1000)
    {
        parent::__construct($this->message);
    }
}
