<?php

namespace Src\Name\Presentation\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Src\Name\Application\Payloads\CreateCustomerPayload;
use Src\Name\Application\Payloads\DeleteCustomerPayload;
use Src\Name\Application\Payloads\FindCustomerPayload;
use Src\Name\Application\Payloads\UpdateCustomerPayload;
use Src\Name\Presentation\Requests\StoreCustomerRequest;
use Src\Name\Presentation\Requests\UpdateCustomerRequest;
use Src\Shared\Application\CommandBusInterface;
use OpenApi\Annotations as OA;
use Src\Name\Domain\Entities\Customer;
use Src\Name\Presentation\Api\ApiResources\CustomerResource;

class CustomerController extends Controller
{


    public function __construct(private CommandBusInterface $bus)
    {
    }
    /**
     * @OA\Post(
     *     path="/api/customers",
     *     summary="Create a new customer",
     *     @OA\RequestBody(
     *         description="New customer details",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreCustomerRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Customer created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Customer")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     */
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

        return response()->json(
            CustomerResource::EntityToArray($customer),
            201
        );
    }
    /**
     * @OA\Put(
     *     path="/api/customers/{id}",
     *     summary="Update a customer by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema={
     *             "@type": "string",
     *             "description": "ID of the customer"
     *         }
     *     ),
     *     @OA\RequestBody(
     *         description="Update customer details",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateCustomerRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Customer")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Customer not found"
     *     )
     * )
     */
    public function update($id, UpdateCustomerRequest $request)
    {
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
            CustomerResource::EntityToArray($customer),
            200
        );
    }

    /**
     * @OA\Get(
     *     path="/api/customers/{id}",
     *     summary="Retrieve a customer by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema={
     *             "@type": "string",
     *             "description": "ID of the customer"
     *         }
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of customer",
     *         @OA\JsonContent(ref="#/components/schemas/Customer")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Customer not found"
     *     )
     * )
     */
    public function show($id)
    {
        $findCustomerPayload = new FindCustomerPayload($id);

        $customer = $this->bus->dispatch($findCustomerPayload);

        return response()->json(
            CustomerResource::EntityToArray($customer)
        );
    }

    /**
     * @OA\Delete(
     *     path="/api/customers/{id}",
     *     summary="Delete a customer by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         schema={
     *             "@type": "string",
     *             "description": "ID of the customer"
     *         }
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Customer deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Customer not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $deleteCustomerPayload = new DeleteCustomerPayload($id);

        if ($this->bus->dispatch($deleteCustomerPayload))
            return response(null, 204);
    }
}
