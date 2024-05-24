<?php

namespace Src\Name\Application\Repositories;

use Src\Name\Domain\Entities\Customer;

interface CustomerWriteInterfaceRepository
{
    public function save(Customer $customer);

    public function destroy(int $customerId): bool;
}
