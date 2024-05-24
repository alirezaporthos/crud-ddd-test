<?php

namespace Src\Name\Application\DTOs;


class DeleteCustomerData
{
    public function __construct(public int $customerId)
    {
    }
}
