<?php

namespace Src\Shared\Domain\Entities;

interface HasKeyInterface
{
    public function getKey(): string|int|null;
}
