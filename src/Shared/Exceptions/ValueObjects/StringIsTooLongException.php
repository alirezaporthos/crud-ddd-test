<?php

namespace Src\Shared\Exceptions\ValueObjects;

use Src\Shared\Exceptions\DomainException;

class StringIsTooLongException extends DomainException
{
    public function __construct(public $message = "String is too long", public $limit = 1000)
    {
        parent::__construct($this->message);
    }
}
