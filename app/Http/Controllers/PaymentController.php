<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\PaymentEngine;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private PaymentEngine $PaymentGateways;

    public function __construct(PaymentEngine $PaymentGateways)
    {
        $this->PaymentGateways = $PaymentGateways;
    }

    public function index(): Object
    {

        $alltransactions = $this->PaymentGateways->alltransactions();
        return view('mypayments', ['alltransactions' => $alltransactions]);

    }

    public function storetrans(Request $request): Object
    {
        $defaultpmethod = $this->PaymentGateways->getdefaultpayment();
         $defname = $defaultpmethod[0]->pname;
        $pcharges = $defaultpmethod[0]->pcharges;


        $Details = $request->only([
            'transname',
            'amount'])
         + [
                'user_id' =>   Auth::id(),
                'transid' =>   rand(0000,8999),
                'paymentmth' =>   $defname ,
                'totalamt' =>    ($request->amount + ($request->amount*$pcharges)),
            ];

        if ($this->PaymentGateways->storetransactions($Details)) {
            return redirect("mypayment")->withSuccess('Transaction Successfully Saved, You can Pay Now');
        }
        return redirect("mypayment")->withError('Error Saving Transaction');

    }

    public function makepayment(Request $request)
    {
          $Details = $request->only(
                'transid');

          $stripesurl =  $this->PaymentGateways->stripepg($Details);

        redirect()->to($stripesurl)->send();

    }

     public function paymentsuccess(Request $request)
    {
        // print_r($request);

        //mock payment update
        $this->PaymentGateways->updatetransactions();
        return redirect("mypayment")->withSuccess('Your Payment was Successfully');
    }

    public function paymentfailed(Request $request)
    {

        return redirect("mypayment")->withError('Payment Failed or was cancelled');
    }

}
