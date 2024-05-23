<?php

namespace Src\Shared\Domain\ValueObjects;

use Src\Shared\Exceptions\ValueObjects\StringIsTooLongException;
use Throwable;

class StringValue
{

    public function __construct(private ?string $value, private readonly ?int $limit = 1000)
    {
        //TODO refactor these
        if (is_string($this->value) && is_int($limit) && strlen($this->value) > $limit) {
            throw (
                new Throwable(
                    new StringIsTooLongException(limit: $limit)
                )
            );
        }
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }
}
