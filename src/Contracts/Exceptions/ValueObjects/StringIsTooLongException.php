<?php

namespace Src\Contracts\Exception\ValueObjects;

use Src\Contracts\Exception\DomainException;

class StringIsTooLongException extends DomainException
{
    public function __construct(public $message = "String is too long", public $limit = 1000)
    {
        parent::__construct($this->message);
    }
}
