<?php

namespace Src\Shared\Domain\ValueObjects;

use Src\Shared\Exceptions\ValueObjects\EmailIsInvalid;

class EmailValue
{
    private string $address;

    public function __construct(string $address = null)
    {
        $this->validate($address);
        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    private function validate(string $address = null): void
    {
        // Basic email validation
        if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
            throw new EmailIsInvalid("Invalid email address: $address");
        }
    }
}
