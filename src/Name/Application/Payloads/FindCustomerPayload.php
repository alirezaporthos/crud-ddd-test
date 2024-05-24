<?php

namespace Src\Name\Application\Payloads;


class FindCustomerPayload
{
    public function __construct(public int $customerId)
    {
    }
}
