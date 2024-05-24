<?php

namespace Src\Name\Application\DTOs;

class UpdateCustomerData
{
    public function __construct(
        public int $customerId,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $dateOfBirth,
        public ?string $phoneNumber,
        public ?string $bankAccountNumber,
        public ?string $email,
    ) {
    }
}
