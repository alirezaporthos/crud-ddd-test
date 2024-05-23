<?php

namespace Src\Name\Domain\Entities;

use Src\Name\Domain\ValueObjects\CustomerBankAccountNumber;
use Src\Name\Domain\ValueObjects\CustomerDateofBirth;
use Src\Name\Domain\ValueObjects\CustomerEmail;
use Src\Name\Domain\ValueObjects\CustomerId;
use Src\Name\Domain\ValueObjects\CustomerFirstName;
use Src\Name\Domain\ValueObjects\CustomerLastName;
use Src\Name\Domain\ValueObjects\CustomerPhoneNumber;
use Src\Shared\Domain\Entity\HasKeyInterface;

class Customer implements HasKeyInterface
{
    public function __construct(
        private CustomerId $id,
        private CustomerFirstName $firstName,
        private CustomerLastName $lastName,
        private CustomerPhoneNumber $phoneNumber,
        private CustomerBankAccountNumber $bankAccountNumber,
        private CustomerEmail $email,
        private CustomerDateofBirth $dateOfBirth
    ) {
    }

    public function getKey(): string|int|null
    {
        return $this->getId()?->getValue();
    }

    public function getId(): CustomerId
    {
        return $this->id;
    }

    public function setId(CustomerId $id): void
    {
        $this->id = $id;
    }

    public function setFirstName(CustomerFirstName $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setDateOfBirth(CustomerDateofBirth $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function setLastName(CustomerLastName $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setPhoneNumber(CustomerPhoneNumber $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function setBankAccountNumber(CustomerBankAccountNumber $bankAccountNumber): void
    {
        $this->bankAccountNumber = $bankAccountNumber;
    }

    public function getFirstName(): CustomerFirstName
    {
        return $this->firstName;
    }

    public function getDateOfBirth(): CustomerDateofBirth
    {
        return $this->dateOfBirth;
    }

    public function getLastName(): CustomerLastName
    {
        return $this->lastName;
    }

    public function getEmail(): CustomerEmail
    {
        return $this->email;
    }

    public function getPhoneNumber(): CustomerPhoneNumber
    {
        return $this->phoneNumber;
    }

    public function getBankAccountNumber(): CustomerBankAccountNumber
    {
        return $this->bankAccountNumber;
    }
}
