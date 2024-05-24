<?php

namespace Src\Name\Presentation\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Name\Application\Commands\CreateCustomerCommandHandler;
use Src\Name\Application\Commands\DeleteCustomerCommandHandler;
use Src\Name\Application\Commands\UpdateCustomerCommandHandler;
use Src\Name\Application\DTOs\CreateCustomerData;
use Src\Name\Application\DTOs\DeleteCustomerData;
use Src\Name\Application\DTOs\FindCustomerData;
use Src\Name\Application\DTOs\UpdateCustomerData;
use Src\Name\Application\Queries\FindCustomerQueryHandler;
use Src\Name\Presentation\Requests\StoreCustomerRequest;

class CustomerController extends Controller
{
    public function store(StoreCustomerRequest $request, CreateCustomerCommandHandler $command): JsonResponse
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

    public function update($id, Request $request, UpdateCustomerCommandHandler $command)
    {
        //TODO make requests for these
        $customerDTO = new UpdateCustomerData(
            $id,
            $request->first_name,
            $request->last_name,
            $request->date_of_birth,
            $request->phone_number,
            $request->bank_account_number,
            $request->email
        );

        $customer = $command->handle($customerDTO);

        return response()->json(
            [
                'first_name' => $customer->getFirstName()->getValue(),
                'last_name' => $customer->getLastName()->getValue(),
                'phone_number' => $customer->getPhoneNumber()->getValue(),
                'bank_account_number' => $customer->getBankAccountNumber()->getValue(),
                'date_of_birth' => $customer->getDateOfBirth()->getDateTime()->format('D M d Y H:i:s T'),
                'email' => $customer->getEmail()->getAddress()
            ],
            200
        );
    }
    public function show($id, FindCustomerQueryHandler $query)
    {
        $findCustomerDTO = new FindCustomerData($id);

        //TODO change DTO to payload
        $customer = $query->handle($findCustomerDTO);

        //TODO refactor this to viewModels
        return response()->json(
            [
                'id' => $customer->getId()->getValue(),
                'first_name' => $customer->getFirstName()->getValue(),
                'last_name' => $customer->getLastName()->getValue(),
                'phone_number' => $customer->getPhoneNumber()->getValue(),
                'bank_account_number' => $customer->getBankAccountNumber()->getValue(),
                'date_of_birth' => $customer->getDateOfBirth()->getDateTime()->format('D M d Y H:i:s T'),
                'email' => $customer->getEmail()->getAddress()
            ]
        );
    }

    public function destroy($id, DeleteCustomerCommandHandler $command)
    {
        $deleteCustomerDTO = new DeleteCustomerData($id);

        if ($command->handle($deleteCustomerDTO))
            return response(null, 204);
    }
}
