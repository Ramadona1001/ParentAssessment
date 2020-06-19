<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_users_data()
    {
        // $response = $this->get(route('users.apis'));
        // $response->assertStatus(200);

        $this->json('GET',route('users.apis'))
             ->assertStatus(200);
        
    }

    public function test_users_filter()
    {
        $provider = $this->json('GET',url('/api/v1/users?provider=DataProviderX'))
                         ->assertStatus(200);
        $currency = $this->json('GET',url('/api/v1/users?currency=USD'))
                          ->assertStatus(200);
        $statusCode = $this->json('GET',url('/api/v1/users?statusCode=authorised'))
                          ->assertStatus(200);
        $balance = $this->json('GET',url('/api/v1/users?balanceMin=10&balanceMax=100'))
                          ->assertStatus(200);
        $all = $this->json('GET',url('/api/v1/users?provider=DataProviderX&currency=USD&statusCode=authorised&balanceMin=10&balanceMax=100'))
                          ->assertStatus(200);
    }
}
