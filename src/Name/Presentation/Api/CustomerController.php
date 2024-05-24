<?php

namespace Src\Name\Presentation\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Src\Name\Application\Commands\CreateCustomerCommandHandler;
use Src\Name\Application\Commands\DeleteCustomerCommandHandler;
use Src\Name\Application\Commands\UpdateCustomerCommandHandler;
use Src\Name\Application\Payloads\CreateCustomerPayload;
use Src\Name\Application\Payloads\DeleteCustomerPayload;
use Src\Name\Application\Payloads\FindCustomerPayload;
use Src\Name\Application\Payloads\UpdateCustomerPayload;
use Src\Name\Application\Queries\FindCustomerQueryHandler;
use Src\Name\Presentation\Requests\StoreCustomerRequest;
use Src\Name\Presentation\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    public function store(StoreCustomerRequest $request, CreateCustomerCommandHandler $command): JsonResponse
    {
        $createCustomerPayload = new CreateCustomerPayload(
            $request->first_name,
            $request->last_name,
            $request->date_of_birth,
            $request->phone_number,
            $request->bank_account_number,
            $request->email
        );

        $customer = $command->handle($createCustomerPayload);

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

    public function update($id, UpdateCustomerRequest $request, UpdateCustomerCommandHandler $command)
    {
        //TODO make requests for these
        $updateCustomerPayload = new UpdateCustomerPayload(
            $id,
            $request->first_name,
            $request->last_name,
            $request->date_of_birth,
            $request->phone_number,
            $request->bank_account_number,
            $request->email
        );

        $customer = $command->handle($updateCustomerPayload);

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
        $findCustomerPayload = new FindCustomerPayload($id);

        //TODO change DTO to payload
        $customer = $query->handle($findCustomerPayload);

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
        $deleteCustomerPayload = new DeleteCustomerPayload($id);

        if ($command->handle($deleteCustomerPayload))
            return response(null, 204);
    }
}
