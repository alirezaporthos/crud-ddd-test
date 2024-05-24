<?php

namespace Src\Name\Application\Repositories;


interface CustomerReadInterfaceRepository
{
    public function findOrFail(int $customerId, $columns = ['*']);
}
