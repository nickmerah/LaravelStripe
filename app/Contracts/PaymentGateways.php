<?php

namespace App\Contracts;

use App\Interfaces\PaymentEngine;
use App\Models\PaymentMethod;
use App\Models\Transactions;

class PaymentGateways implements  PaymentEngine
{

    public function alltransactions() {
        return Transactions::all();
    }

    public function storetransactions(array $transDetails)
    {
        return Transactions::create($transDetails);
    }

    public function getdefaultpayment() {
        return PaymentMethod::where('setdefault', 1)->get();
    }

    public function stripepg(array $Details)
{
      $id = $Details['transid'];
      $pd = Transactions::find($id );
       $name  =    $pd->transname ;
        $unit_amount   =  $pd->totalamt*100 ;
        $successurl = url("/successredirect");
         $failurl = url("/failedredirect");
     require_once '../vendor/autoload.php';
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    $checkout_session = $stripe->checkout->sessions->create([
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',

                'product_data' => [
                    'name' => "$name",
                ],
                'unit_amount' => "$unit_amount",
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => $successurl,
        'cancel_url' => $failurl ,
    ]);

 return $checkout_session->url;
}

    public function updatetransactions()
    {

        return  Transactions::where('status', 'Pending')
            ->update([
                'status' => 'Paid'
            ]);
    }

}

