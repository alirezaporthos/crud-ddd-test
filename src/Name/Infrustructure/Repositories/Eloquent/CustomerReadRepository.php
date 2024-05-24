<?php

namespace Src\Name\Infrustructure\Repositories\Eloquent;

use Src\Name\Application\Repositories\CustomerReadInterfaceRepository;
use Src\Name\Domain\Entities\Customer;
use Src\Name\Domain\ValueObjects\CustomerBankAccountNumber;
use Src\Name\Domain\ValueObjects\CustomerDateofBirth;
use Src\Name\Domain\ValueObjects\CustomerEmail;
use Src\Name\Domain\ValueObjects\CustomerFirstName;
use Src\Name\Domain\ValueObjects\CustomerId;
use Src\Name\Domain\ValueObjects\CustomerLastName;
use Src\Name\Domain\ValueObjects\CustomerPhoneNumber;
use Src\Name\Infrustructure\Models\Customer as ModelsCustomer;

class CustomerReadRepository implements CustomerReadInterfaceRepository
{
    public function findOrFail(int $customerId, $columns = ['*'])
    {
        $customerModel = ModelsCustomer::findOrFail($customerId);

        //TODO refactor this to a function
        $customerEntity = new Customer(
            new CustomerId($customerModel->id),
            new CustomerFirstName($customerModel->first_name),
            new CustomerLastName($customerModel->last_name),
            new CustomerPhoneNumber($customerModel->phone_number),
            new CustomerBankAccountNumber($customerModel->bank_account_number),
            new CustomerEmail($customerModel->email),
            new CustomerDateofBirth($customerModel->date_of_birth)
        );

        return $customerEntity;
    }
}
