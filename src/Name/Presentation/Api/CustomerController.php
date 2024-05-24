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
use Src\Shared\Application\CommandBusInterface;

class CustomerController extends Controller
{
    public function __construct(private CommandBusInterface $bus)
    {
    }
    public function store(StoreCustomerRequest $request): JsonResponse
    {
        $createCustomerPayload = new CreateCustomerPayload(
            $request->first_name,
            $request->last_name,
            $request->date_of_birth,
            $request->phone_number,
            $request->bank_account_number,
            $request->email
        );

        // this is another way of using command bus
        // $customer = CreateCustomerPayload::dispatch(
        //     $request->first_name,
        //     $request->last_name,
        //     $request->date_of_birth,
        //     $request->phone_number,
        //     $request->bank_account_number,
        //     $request->email
        // );
        $customer = $this->bus->dispatch($createCustomerPayload);

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

    public function update($id, UpdateCustomerRequest $request)
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

        $customer = $this->bus->dispatch($updateCustomerPayload);

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
    public function show($id)
    {
        $findCustomerPayload = new FindCustomerPayload($id);

        $customer = $this->bus->dispatch($findCustomerPayload);

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

    public function destroy($id)
    {
        $deleteCustomerPayload = new DeleteCustomerPayload($id);

        if ($this->bus->dispatch($deleteCustomerPayload))
            return response(null, 204);
    }
}
