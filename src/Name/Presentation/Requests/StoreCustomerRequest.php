<?php

namespace Src\Name\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Src\Name\Infrustructure\Models\Customer;
use Src\Name\Presentation\Requests\Rules\PhoneNumberRule;
use Src\Name\Presentation\Requests\Rules\UniqueCombinationRule;

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
