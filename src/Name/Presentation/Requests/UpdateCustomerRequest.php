<?php

namespace Src\Name\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Src\Name\Infrustructure\Models\Customer;
use Src\Name\Presentation\Requests\Rules\PhoneNumberRule;

class UpdateCustomerRequest extends FormRequest
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
                'nullable', 'string', 'max:50',
                Rule::unique(Customer::class, 'first_name')
                    ->ignore($this->route('id'))
                    ->where('date_of_birth', $this->input('date_of_birth'))
                    ->where('last_name', $this->input('last_name')),
            ],
            'last_name' => [
                'nullable', 'string', 'max:50',
                Rule::unique(Customer::class, 'last_name')
                    ->ignore($this->route('id'))
                    ->where('date_of_birth', $this->input('date_of_birth'))
                    ->where('first_name', $this->input('first_name')),
            ],
            'date_of_birth' => [
                'date',
                'nullable',
                Rule::unique(Customer::class, 'date_of_birth')
                    ->ignore($this->route('id'))
                    ->where('first_name', $this->input('first_name'))
                    ->where('last_name', $this->input('last_name')),
            ],
            'phone_number' => ['nullable', new PhoneNumberRule],
            'email' => ['nullable', Rule::unique('customers', 'email')->ignore($this->route('id'))],
            'bank_account_number' => ['nullable', 'numeric', 'digits_between:9,18'],
        ];
    }
}
