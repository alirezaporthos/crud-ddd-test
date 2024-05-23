<?php

namespace Src\Name\Presentation\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Name\Application\Commands\CreateCustomerCommandHandler;
use Src\Name\Application\DTOs\CreateCustomerData;

class CustomerController extends Controller
{
    public function store(Request $request, CreateCustomerCommandHandler $command): JsonResponse
    {
        $customerDTO = new CreateCustomerData(
            $request->first_name,
            $request->last_name,
            $request->date_of_birth,
            $request->phone_number,
            $request->bank_account_number,
            $request->email
        );

        $customer = $command->handle($customerDTO);

        //TODO refactor this to viewModels
        return response()->json(
            [
                'first_name' => $customer->getFirstName()->getValue(),
                'last_name' => $customer->getLastName()->getValue(),
                'phone_number' => $customer->getPhoneNumber()->getValue(),
                'bank_account_number' => $customer->getBankAccountNumber()->getValue(),
                'date_of_birth' => $customer->getDateOfBirth()->getDateTime()->format('D M d Y H:i:s T'),
                'email' => $customer->getEmail()->getAddress()
            ],
            201
        );
    }
}
