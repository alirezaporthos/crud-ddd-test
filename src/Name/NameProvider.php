<?php

namespace Src\Name;

use Illuminate\Support\ServiceProvider;
use Src\Name\Application\Repositories\CustomerWriteInterfaceRepository;
use Src\Name\Infrustructure\Repositories\Eloquent\CustomerWriteRepository;

class NameProvider extends ServiceProvider
{
    public function register()
    {
        app()->bind(CustomerWriteInterfaceRepository::class, CustomerWriteRepository::class);
    }
}
