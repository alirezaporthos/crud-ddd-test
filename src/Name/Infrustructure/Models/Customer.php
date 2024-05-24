<?php

namespace Src\Name\Infrustructure\Models;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return new CustomerFactory();
    }
}
