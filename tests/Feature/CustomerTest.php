<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Src\Name\Domain\Entities\Customer;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_customer_by_id()
    {
        $customer = Customer::factory()->create();

        $response = $this->get("/api/customers/{$customer->id}");

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'id' => $customer->id,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'date_of_birth' => $customer->date_of_birth,
            'phone_number' => $customer->phone_number,
            'email' => $customer->email,
            'bank_account_number' => $customer->bank_account_number,
        ]);
    }

    public function test_can_create_customer()
    {

        $data = [
            'first_name' => 'Alireza',
            'last_name' => 'Porthos',
            'date_of_birth' => now()->toString(),
            'phone_number' => '09910451706',
            'email' => 'alireza@example.com',
            'bank_account_number' => '1234567890123456',
        ];

        $response = $this->post('/api/customers', $data);

        $response->assertStatus(201);
        $response->assertJsonFragment($data);
    }

    public function test_can_update_customer()
    {
        $customer = Customer::factory()->create();

        $updatedData = [
            'first_name' => 'Porthos',
            'last_name' => 'Alireza',
        ];

        $response = $this->put("/api/customers/{$customer->id}", $updatedData);

        $response->assertStatus(200);
        $response->assertJsonFragment($updatedData);
    }

    public function test_can_delete_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->delete("/api/customers/{$customer->id}");

        $response->assertStatus(204);
    }
}
