<?php


namespace App\Repositories;

use App\Interfaces\PaymentMethodRepositoryInterface;
use App\Models\PaymentMethod;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{
    public function getAllPaymentMethod()
    {
        return PaymentMethod::all();
    }

    public function createPaymentMethod(array $pmDetails)
    {
        return PaymentMethod::create($pmDetails);
    }

    public function getPaymentMethodById($pgId)
    {
        $pgate =  PaymentMethod::findOrFail($pgId);
        $response['pname'] = $pgate['pname'];
        $response['pdescription'] = $pgate['pdescription'];
        $response['pcharges'] = $pgate['pcharges'];
        $response['done'] = true;
        return $response;
    }

    public function updatePaymentMethod(object $pmDetails)
    {
        $pmth = PaymentMethod::find($pmDetails->route('id'));
        $pmth->pname   =    $pmDetails->pname ;
        $pmth->pdescription   =  $pmDetails->pdescription ;
        $pmth->pcharges   = $pmDetails->pcharges;
        $pmth->save();
        $response['success'] = true;
        return $response;

    }

    public function updatePaymentMethodByDefault(object $pmDetails)
    {
        $pmth = PaymentMethod::find($pmDetails->route('id'));
        if ($pmth->id){
            PaymentMethod::where('setdefault', 1)->update(['setdefault' => 0]);//clear previous default
            PaymentMethod::where('id', $pmth->id)->update(['setdefault' => 1]); // set new default
            $response['success'] = true;
            return $response;
        }

        $response['success'] = false;
        return $response;

    }

    public function deletePaymentMethod($pmId)
    {
        PaymentMethod::destroy($pmId);
         $response['success'] = true;
         return $response;
    }






}
