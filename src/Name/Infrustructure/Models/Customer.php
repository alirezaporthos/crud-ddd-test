<?php

namespace Src\Name\Infrustructure\Models;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'bank_account_number',
        'email',
        'date_of_birth'
    ];

    protected static function newFactory()
    {
        return new CustomerFactory();
    }
}
