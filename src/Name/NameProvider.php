<?php

namespace Src\Name;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;
use Src\Name\Application\Commands\CreateCustomerCommandHandler;
use Src\Name\Application\Commands\DeleteCustomerCommandHandler;
use Src\Name\Application\Commands\UpdateCustomerCommandHandler;
use Src\Name\Application\Payloads\CreateCustomerPayload;
use Src\Name\Application\Payloads\DeleteCustomerPayload;
use Src\Name\Application\Payloads\FindCustomerPayload;
use Src\Name\Application\Payloads\UpdateCustomerPayload;
use Src\Name\Application\Queries\FindCustomerQueryHandler;
use Src\Name\Application\Repositories\CustomerReadInterfaceRepository;
use Src\Name\Application\Repositories\CustomerWriteInterfaceRepository;
use Src\Name\Infrustructure\Repositories\Eloquent\CustomerReadRepository;
use Src\Name\Infrustructure\Repositories\Eloquent\CustomerWriteRepository;
use Src\Shared\Application\CommandBusInterface;
use Src\Shared\Infrustructure\CommandBus as InfrustructureCommandBus;

class NameProvider extends ServiceProvider
{
    // public function boot()
    // {
    //     Bus::map([
    //         CreateCustomerPayload::class => CreateCustomerCommandHandler::class,
    //         DeleteCustomerPayload::class => DeleteCustomerCommandHandler::class,
    //         FindCustomerPayload::class => FindCustomerQueryHandler::class,
    //         UpdateCustomerPayload::class => UpdateCustomerCommandHandler::class
    //     ]);
    // }
    public function register()
    {
        app()->bind(CustomerWriteInterfaceRepository::class, CustomerWriteRepository::class);
        app()->bind(CustomerReadInterfaceRepository::class, CustomerReadRepository::class);

        $this->app->singleton(CommandBusInterface::class, InfrustructureCommandBus::class);
        $bus = app()->make(CommandBusInterface::class);

        $bus->map([
            CreateCustomerPayload::class => CreateCustomerCommandHandler::class,
            DeleteCustomerPayload::class => DeleteCustomerCommandHandler::class,
            FindCustomerPayload::class => FindCustomerQueryHandler::class,
            UpdateCustomerPayload::class => UpdateCustomerCommandHandler::class
        ]);
    }
}
