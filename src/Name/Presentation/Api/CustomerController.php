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
     *         @OA\JsonContent(
     *             type="object",
     *             description="first_name,last_name and date_of_birth combination must be unique",
     *             required={"first_name", "last_name", "date_of_birth", "email", "phone_number", "bank_account_number"},
     *             @OA\Property(property="first_name", type="string", example="Alireza"),
     *             @OA\Property(property="last_name", type="string", example="Porthos"),
     *             @OA\Property(property="date_of_birth", type="string", format="date-time", example="1999-11-9"),
     *             @OA\Property(property="phone_number", type="string", example="09910451706"),
     *             @OA\Property(property="bank_account_number", type="string",  minLength=9, maxLength=18, example=1234567890),
     *             @OA\Property(property="email", type="string", format="email", example="alireza@test.com")
     *         )
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
     *         description="Updated customer details",
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="first_name",  type="string", example="Alireza"),
     *             @OA\Property(property="last_name", type="string", example="Porthos"),
     *             @OA\Property(property="date_of_birth", type="string", format="date-time", example="1999-11-9"),
     *             @OA\Property(property="phone_number", type="string", example="09910451706"),
     *             @OA\Property(property="bank_account_number", type="string",  minLength=9, maxLength=18, example=1234567890),
     *             @OA\Property(property="email", type="string", format="email", example="alireza@test.com")
     *         )
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
