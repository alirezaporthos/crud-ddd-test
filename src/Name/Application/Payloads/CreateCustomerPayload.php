<?php

namespace Src\Name\Application\Payloads;

class CreateCustomerPayload
{
    public function __construct(
        public ?string $firstName,
        public ?string $lastName,
        public ?string $dateOfBirth,
        public ?string $phoneNumber,
        public ?string $bankAccountNumber,
        public ?string $email,
    ) {
    }
}
