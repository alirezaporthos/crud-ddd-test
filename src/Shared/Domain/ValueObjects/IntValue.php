<?php

namespace Src\Shared\Domain\ValueObjects;

use Src\Shared\Exceptions\ValueObjects\NumberIsLessThanMinException;
use Src\Shared\Exceptions\ValueObjects\NumberIsMoreThanMaxException;

use Throwable;

class IntValue
{

    public function __construct(private ?int $value, private readonly ?int $min = 0, private readonly ?int $max = null)
    {
        //TODO refactor these
        if (is_int($this->value) && is_int($min) && $this->value < $min) {
            throw (
                new Throwable(
                    new NumberIsLessThanMinException(min: $min)
                )
            );
        }

        if (is_int($this->value) && is_int($max) && $this->value > $max) {
            throw (
                new Throwable(
                    new NumberIsMoreThanMaxException(max: $max)
                )
            );
        }
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }
}
