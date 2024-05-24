<?php

namespace Src\Name\Application\Commands;


use Src\Name\Application\Payloads\DeleteCustomerPayload;
use Src\Name\Application\Repositories\CustomerWriteInterfaceRepository;


readonly class DeleteCustomerCommandHandler
{
    public function __construct(
        private CustomerWriteInterfaceRepository $writeRepository
    ) {
    }

    public function handle(DeleteCustomerPayload $data)
    {
        return $this->writeRepository->destroy($data->customerId);
    }
}
