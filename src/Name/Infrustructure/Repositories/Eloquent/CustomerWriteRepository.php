<?php

namespace Src\Name\Infrustructure\Repositories\Eloquent;

use Src\Name\Application\Repositories\CustomerWriteInterfaceRepository;
use Src\Name\Domain\Entities\Customer;
use Src\Name\Infrustructure\Models\Customer as ModelsCustomer;

class CustomerWriteRepository implements CustomerWriteInterfaceRepository
{
    public function save(Customer $customerEntity): Customer
    {
        $customer = new ModelsCustomer();

        $customer->first_name = $customerEntity->GetFirstName()->getValue();
        $customer->last_name = $customerEntity->getLastName()->getValue();
        $customer->bank_account_number = $customerEntity->getBankAccountNumber()->getValue();
        $customer->phone_number = $customerEntity->getPhoneNumber()->getValue();

        //TODO maybe change these so every object value would have a getValue()
        $customer->email = $customerEntity->getEmail()->getAddress();
        $customer->date_of_birth = $customerEntity->getDateOfBirth()->getDateTime();

        $customer->save();

        $customerEntity->getId()->setValue($customer->id);

        return $customerEntity;
    }
}
