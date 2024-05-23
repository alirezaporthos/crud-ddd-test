<?php

namespace Src\Name\Presentation\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Name\Application\Commands\CreateCustomerCommandHandler;
use Src\Name\Application\DTOs\CreateCustomerData;

class CustomerController extends Controller
{
    public function store(Request $request, CreateCustomerCommandHandler $command)
    {
        $customerDTO = new CreateCustomerData(
            $request->firstName,
            $request->lastName,
            $request->dateOfBirth,
            $request->phoneNumber,
            $request->bankAccountNumber,
            $request->email
        );
        return $command->handle($customerDTO);
    }
}
