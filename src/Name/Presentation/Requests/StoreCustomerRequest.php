<?php

namespace Src\Name\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Src\Name\Infrustructure\Models\Customer;
use Src\Name\Presentation\Requests\Rules\PhoneNumberRule;
use Src\Name\Presentation\Requests\Rules\UniqueCombinationRule;

/**
 * @OA\Schema(
 *     schema="StoreCustomerRequest",
 *     title="Store Customer Request",
 *     description="Store customer request body",
 *     required={"first_name", "date_of_birth", "last_name", "email", "phone_number", "bank_account_number"},
 *     @OA\Property(property="first_name",  type="string", example="Alireza"),
 *     @OA\Property(property="last_name", type="string", example="Porthos"),
 *     @OA\Property(property="date_of_birth", type="string", format="date-time", example="1999-11-9"),
 *     @OA\Property(property="phone_number", type="string", example="09910451706"),
 *     @OA\Property(property="bank_account_number", type="string",  minLength=9, maxLength=18, example=1234567890),
 *     @OA\Property(property="email", type="string", format="email", example="alireza@test.com")
 * )
 */
class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required', 'string', 'max:50',
                Rule::unique(Customer::class, 'first_name')
                    ->where('date_of_birth', $this->input('date_of_birth'))
                    ->where('last_name', $this->input('last_name')),
            ],
            'last_name' => [
                'required', 'string', 'max:50',
                Rule::unique(Customer::class, 'last_name')
                    ->where('date_of_birth', $this->input('date_of_birth'))
                    ->where('first_name', $this->input('first_name')),
            ],
            'date_of_birth' => [
                'date',
                'required',
                Rule::unique(Customer::class, 'date_of_birth')
                    ->where('first_name', $this->input('first_name'))
                    ->where('last_name', $this->input('last_name')),
            ],
            'phone_number' => ['required', new PhoneNumberRule],
            'email' => ['required', Rule::unique('customers', 'email')],
            'bank_account_number' => ['required', 'numeric', 'digits_between:9,18'],
        ];
    }
}
