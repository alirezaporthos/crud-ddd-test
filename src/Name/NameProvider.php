<?php

namespace Src\Name;

use Illuminate\Support\ServiceProvider;
use Src\Name\Application\Repositories\CustomerReadInterfaceRepository;
use Src\Name\Application\Repositories\CustomerWriteInterfaceRepository;
use Src\Name\Infrustructure\Repositories\Eloquent\CustomerReadRepository;
use Src\Name\Infrustructure\Repositories\Eloquent\CustomerWriteRepository;

class NameProvider extends ServiceProvider
{
    public function register()
    {
        app()->bind(CustomerWriteInterfaceRepository::class, CustomerWriteRepository::class);
        app()->bind(CustomerReadInterfaceRepository::class, CustomerReadRepository::class);
    }
}
