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
            $request->first_name,
            $request->last_name,
            $request->date_of_birth,
            $request->phone_number,
            $request->bank_account_number,
            $request->email
        );

        return $command->handle($customerDTO);
    }
}
