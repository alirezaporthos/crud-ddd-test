<?php

namespace Src\Contracts\Domain\Entity;

interface HasKeyInterface
{
    public function getKey(): string|int|null;
}
