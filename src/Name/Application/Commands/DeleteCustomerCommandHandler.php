<?php

namespace Src\Name\Application\Commands;

use DateTime;
use Src\Name\Application\DTOs\DeleteCustomerData;
use Src\Name\Application\Repositories\CustomerWriteInterfaceRepository;
use Src\Name\Domain\Entities\Customer;
use Src\Name\Domain\ValueObjects\CustomerBankAccountNumber;
use Src\Name\Domain\ValueObjects\CustomerDateofBirth;
use Src\Name\Domain\ValueObjects\CustomerEmail;
use Src\Name\Domain\ValueObjects\CustomerFirstName;
use Src\Name\Domain\ValueObjects\CustomerId;
use Src\Name\Domain\ValueObjects\CustomerLastName;
use Src\Name\Domain\ValueObjects\CustomerPhoneNumber;
use Src\Name\Infrustructure\Repositories\Eloquent\CustomerReadRepository;

readonly class DeleteCustomerCommandHandler
{
    public function __construct(
        private CustomerWriteInterfaceRepository $writeRepository
    ) {
    }

    public function handle(DeleteCustomerData $data)
    {
        return $this->writeRepository->destroy($data->customerId);
    }
}
