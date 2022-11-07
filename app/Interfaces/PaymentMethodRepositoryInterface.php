<?php
namespace App\Interfaces;

interface PaymentMethodRepositoryInterface
{
    public function getAllPaymentMethod();
    public function getPaymentMethodById($pmId);
    public function deletePaymentMethod($pmId);
    public function createPaymentMethod(array $pmDetails);
    public function updatePaymentMethod(object $pmDetails);
    public function updatePaymentMethodByDefault(object $pmDetails);

}
