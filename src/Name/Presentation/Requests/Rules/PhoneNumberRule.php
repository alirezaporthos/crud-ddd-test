<?php

namespace Src\Name\Presentation\Requests\Rules;

use Closure;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;
use libphonenumber\PhoneNumberUtil;

class PhoneNumberRule implements ValidationRule
{
    public function __construct(private string $region = 'IR')
    {
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        $phoneNumber = $phoneUtil->parse($value, $this->region);
        try {
            if (!$phoneUtil->isValidNumber($phoneNumber)) {
                $fail('The :attribute must be a valid phone number.');
            }
        } catch (Exception) {
            $fail('The :attribute must be valid phone number.');
        }
    }
}
