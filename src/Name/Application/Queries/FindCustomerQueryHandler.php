<?php

namespace Src\Name\Application\Queries;

use Src\Name\Application\Payloads\FindCustomerPayload;
use Src\Name\Application\Repositories\CustomerReadInterfaceRepository;

class FindCustomerQueryHandler
{
    public function __construct(private CustomerReadInterfaceRepository $readRepository)
    {
    }

    public function handle(FindCustomerPayload $data)
    {
        return $this->readRepository->findOrFail($data->customerId);
    }
}
