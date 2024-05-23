<?php

namespace Src\Shared\Domain\ValueObjects;

class PhoneNumberValue
{

    public function __construct(private ?string $value, private ?string $type = "IR")
    {
        $this->validate($value, $type);
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    public function validate($value, $type)
    {
        $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
        $phoneUtil->parse($value, $type);
    }
}
