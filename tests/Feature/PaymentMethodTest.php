<?php

namespace Tests\Feature;
use App\Models\PaymentMethod;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PaymentMethodTest extends TestCase
{
    //payment method CRUD functionality
    public function test_get_all_payment_method_by_id()
    {
        $this->withoutMiddleware();
        $pid = PaymentMethod::get()->random()->id;
        $response = $this->get('/paymentmethod/'. $pid)
                    ->assertStatus(Response::HTTP_OK)
                    ->assertJsonStructure(
                [   'pname',
                    'pdescription',
                    'pcharges',
                    'done',
                ]
            );
    }

    public function test_get_all_payment_method()
    {
        $this->withoutMiddleware();
        $this->json('GET', '/paymentmethod')
            ->assertStatus(Response::HTTP_OK);

    }

    public function test_save_payment_method()
    {
        $this->withoutMiddleware();

        $data = [
            'pname' => "Stripe",
            'pdescription' => "Pay with Stripe",
            'pcharges' => 0.5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $payload = PaymentMethod::create($data)->toArray();

        $this->json('POST', '/paymentmethod', $payload )
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('paymentmethod');

    }

    public function test_to_update_payment_method()
    {
        $this->withoutMiddleware();
        $pid = PaymentMethod::get()->random()->id;
        $payload = [
            'pname' => "New Payment Method",
            'pdescription' => "Pay with New Payment Method",
            'pcharges' => 0.1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $this->json('PUT', '/paymentmethod/'.$pid, $payload )
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_to_delete_payment_method()
    {
        $this->withoutMiddleware();
        $pid = PaymentMethod::get()->random()->id;

        $this->json('DELETE', '/paymentmethod/'.$pid)
            ->assertStatus(Response::HTTP_OK);
    }
}
