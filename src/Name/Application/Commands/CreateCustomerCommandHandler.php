<?php

namespace Src\Name\Application\Commands;

use Src\Name\Application\Repositories\CustomerWriteInterfaceRepository;
use Src\Name\Domain\Entities\Customer;
use Src\Name\Domain\ValueObjects\CustomerBankAccountNumber;
use Src\Name\Domain\ValueObjects\CustomerDateofBirth;
use Src\Name\Domain\ValueObjects\CustomerEmail;
use Src\Name\Domain\ValueObjects\CustomerFirstName;
use Src\Name\Domain\ValueObjects\CustomerId;
use Src\Name\Domain\ValueObjects\CustomerLastName;
use Src\Name\Domain\ValueObjects\CustomerPhoneNumber;
use Srs\Name\Application\DTOs\CreateCustomerData;

readonly class CreateCustomerCommandHandler
{
    public function __construct(private CustomerWriteInterfaceRepository $writeRepository)
    {
    }

    public function handle(CreateCustomerData $data)
    {

        $customer = new Customer(
            new CustomerId(),
            new CustomerFirstName($data->firstName),
            new CustomerLastName($data->lastName),
            new CustomerPhoneNumber($data->phoneNumber),
            new CustomerBankAccountNumber($data->bankAccountNumber),
            new CustomerEmail($data->email),
            new CustomerDateofBirth($data->dateOfBirth)
        );

        return $this->writeRepository->save($customer);
    }
}
