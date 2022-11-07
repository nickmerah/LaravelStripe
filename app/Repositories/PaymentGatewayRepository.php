<?php


namespace App\Repositories;

use App\Interfaces\PaymentGatewayRepositoryInterface;

use App\Models\PaymentGateWay;

class PaymentGatewayRepository implements PaymentGatewayRepositoryInterface
{
    public function getAllPaymentGateway()
    {
        return PaymentGateWay::all();
    }

    public function getPaymentGatewayById($pgId)
    {
        $pgate =  PaymentGateWay::findOrFail($pgId);
        $response['pgname'] = $pgate['pgname'];
        $response['pgdescription'] = $pgate['pgdescription'];
        $response['isActive'] = $pgate['isActive'];
        $response['done'] = true;
        return $response;
    }

    public function deletePaymentGateway($pgId)
    {
          PaymentGateWay::destroy($pgId);
         $response['success'] = true;
        return $response;
    }

    public function createPaymentGateway(array $pgDetails)
    {
        return PaymentGateWay::create($pgDetails);
    }

    public function updatePaymentGateway(object $pgDetails)
    {
        $pmth = PaymentGateWay::find($pgDetails->route('id'));
        $pmth->pgname   =    $pgDetails->pgname ;
        $pmth->pgdescription   =  $pgDetails->pgdescription ;
        $pmth->isActive   = $pgDetails->isActive;
        $pmth->save();
        $response['success'] = true;
        return $response;

    }


}
