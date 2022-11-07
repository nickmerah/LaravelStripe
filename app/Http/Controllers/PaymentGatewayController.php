<?php

namespace App\Http\Controllers;
use App\Interfaces\PaymentGatewayRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class PaymentGatewayController extends Controller
{
    private PaymentGatewayRepositoryInterface $paymentGatewayRepository;

    public function __construct(PaymentGatewayRepositoryInterface $paymentGatewayRepository)
    {
        $this->paymentGatewayRepository = $paymentGatewayRepository;
    }

    public function index(): Object
    {
        $paymentgateways =  $this->paymentGatewayRepository->getAllPaymentGateway();

        return view('paymentgateways', ['paymentgateways' => $paymentgateways]);
    }

    public function store(Request $request): Object
    {
        $pgDetails = $request->only([
            'pgname',
            'pgdescription',
            'isActive'
        ]);
       if ($this->paymentGatewayRepository->createPaymentGateway($pgDetails)) {
           return redirect("paymentgateway")->withSuccess('Payment Gateway Successfully Created');
       }
        return redirect("paymentgateway")->withError('Error Adding Payment Gateway');

    }

    public function paymentgatewayedit(Request $request): JsonResponse
    {
        $pgId = $request->route('id');
        $response =  $this->paymentGatewayRepository->getPaymentGatewayById($pgId);
        return  response()->json($response);

    }

     public function paymentgatewayupdate(Request $request): JsonResponse
    {

        $response =  $this->paymentGatewayRepository->updatePaymentGateway($request );

        return response()->json($response);

    }

    public function paymentgatewaydelete(Request $request): JsonResponse
    {
        $pgId = $request->route('id');
        $response = $this->paymentGatewayRepository->deletePaymentGateway($pgId);

        return  response()->json($response);
    }


}
