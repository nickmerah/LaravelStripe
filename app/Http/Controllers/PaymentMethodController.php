<?php

namespace App\Http\Controllers;

use App\Interfaces\PaymentMethodRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    private PaymentMethodRepositoryInterface $paymentMethodRepository;
    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function index(): Object
    {
        $paymentmethods =  $this->paymentMethodRepository->getAllPaymentMethod();

        return view('paymentmethods', ['paymentmethods' => $paymentmethods]);
    }

    public function store(Request $request): Object
    {
        $pmDetails = $request->only([
            'pname',
            'pdescription',
            'pcharges'
        ]);
        if ($this->paymentMethodRepository->createPaymentMethod($pmDetails)) {
            return redirect("paymentmethod")->withSuccess('Payment Method Successfully Created');
        }
        return redirect("paymentmethod")->withError('Error Adding Payment Method');
    }

    public function paymentmethodedit(Request $request): JsonResponse
    {
        $pmId = $request->route('id');
        $response =  $this->paymentMethodRepository->getPaymentMethodById($pmId);
        return  response()->json($response);

    }

    public function paymentmethodupdate(Request $request): JsonResponse
    {

        $response =  $this->paymentMethodRepository->updatePaymentMethod($request );

        return response()->json($response);

    }

    public function paymentdefaultupdate(Request $request): Object
    {

        $response =  $this->paymentMethodRepository->updatePaymentMethodByDefault($request );

        if ($response) {
            return redirect("paymentmethod")->withSuccess('Payment Default Method Successfully Updated');
        }
        return redirect("paymentmethod")->withError('Error Updating Payment Default Method');

    }


    public function paymentmethoddelete(Request $request): JsonResponse
    {
        $pmId = $request->route('id');
        $response = $this->paymentMethodRepository->deletePaymentMethod($pmId);

        return  response()->json($response);
    }


}
