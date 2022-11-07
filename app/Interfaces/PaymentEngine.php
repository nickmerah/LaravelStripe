<?php

namespace App\Interfaces;
interface PaymentEngine
{
    public function alltransactions();
    public function storetransactions(array $transDetails);
    public function stripepg(array $Details);
    public function updatetransactions();
}
