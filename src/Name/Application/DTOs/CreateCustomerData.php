<?php

namespace Srs\Name\Application\DTOs;

class CreateCustomerData
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
