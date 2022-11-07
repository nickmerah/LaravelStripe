<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    //payment method CRUD functionality
    public function test_example()
    {
        $user = new User(array('name' => 'John'));
        $this->be($user);

        $response = $this->get('/paymentmethod');

        $response->assertStatus(200);
    }
}
