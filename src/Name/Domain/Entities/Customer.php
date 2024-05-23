<?php

namespace Src\Name\Domain\Entities;

use Src\Name\Domain\ValueObjects\CustomerId;
use Src\Shared\Domain\Entity\HasKeyInterface;

class Customer implements HasKeyInterface
{
    public function __construct(private CustomerId $id)
    {
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
}
