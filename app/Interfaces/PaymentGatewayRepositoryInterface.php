<?php
namespace App\Interfaces;

interface PaymentGatewayRepositoryInterface
{
    public function getAllPaymentGateway();
    public function getPaymentGatewayById($pgId);
    public function deletePaymentGateway($pgId);
    public function createPaymentGateway(array $pgDetails);
    public function updatePaymentGateway(object $pgDetails);

}
