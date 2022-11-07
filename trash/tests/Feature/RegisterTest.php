<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_to_register_a_user()
    {
        $this->withoutExceptionHandling();
        $data = [
            'fullnames' => 'Tommy Lee',
            'phoneno' => '08076867686',
            'email' => 'tommy@yahoo.com',
            'password' => 'Upper@123',
            'password_confirm' => 'Upper@123'
        ];
        $response = $this->post('/create-user',  $data );

        $response->assertStatus(200);
        $response->assertRedirect('/login');
    }

    public function test_to_login_a_user()
    {
        $this->withoutExceptionHandling();
        $data = [
            'email' => 'mona@yahoo.com',
            'password' => '1111'
        ];
        $response = $this->post('/post-login',  $data );

        $response->assertStatus(202);


    }

}
