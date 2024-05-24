<?php

namespace Src\Name\Application\Queries;

use Src\Name\Application\DTOs\FindCustomerData;
use Src\Name\Application\Repositories\CustomerReadInterfaceRepository;

class FindCustomerQueryHandler
{
    public function __construct(private CustomerReadInterfaceRepository $readRepository)
    {
    }

    public function handle(FindCustomerData $data)
    {
        return $this->readRepository->findOrFail($data->customerId);
    }
}
