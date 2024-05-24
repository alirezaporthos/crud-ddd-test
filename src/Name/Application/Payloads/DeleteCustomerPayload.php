<?php

namespace Src\Name\Application\Payloads;


class DeleteCustomerPayload
{
    public function __construct(public int $customerId)
    {
    }
}
