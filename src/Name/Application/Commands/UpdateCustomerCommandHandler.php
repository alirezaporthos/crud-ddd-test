<?php

namespace Src\Name\Application\Commands;

use Src\Name\Application\Repositories\CustomerWriteInterfaceRepository;
use Src\Name\Domain\ValueObjects\CustomerBankAccountNumber;
use Src\Name\Domain\ValueObjects\CustomerDateofBirth;
use Src\Name\Domain\ValueObjects\CustomerEmail;
use Src\Name\Domain\ValueObjects\CustomerFirstName;
use Src\Name\Domain\ValueObjects\CustomerLastName;
use Src\Name\Domain\ValueObjects\CustomerPhoneNumber;
use Src\Name\Application\Payloads\UpdateCustomerPayload;
use Src\Name\Application\Repositories\CustomerReadInterfaceRepository;

readonly class UpdateCustomerCommandHandler
{
    public function __construct(
        private CustomerWriteInterfaceRepository $writeRepository,
        private CustomerReadInterfaceRepository $readRepository
    ) {
    }

    public function handle(UpdateCustomerPayload $data)
    {
        $customerEntity = $this->readRepository->findOrFail($data->customerId);

        if ($data->firstName)
            $customerEntity->setFirstName(new CustomerFirstName($data->firstName));
        if ($data->lastName)
            $customerEntity->setLastName(new CustomerLastName($data->lastName));
        if ($data->phoneNumber)
            $customerEntity->setPhoneNumber(new CustomerPhoneNumber($data->phoneNumber));
        if ($data->dateOfBirth)
            $customerEntity->setDateOfBirth(new CustomerDateofBirth($data->dateOfBirth));
        if ($data->email)
            $customerEntity->setEmail(new CustomerEmail($data->email));
        if ($data->bankAccountNumber)
            $customerEntity->setBankAccountNumber(new CustomerBankAccountNumber($data->bankAccountNumber));

        if ($this->writeRepository->update($customerEntity))
            return $customerEntity;
    }
}
