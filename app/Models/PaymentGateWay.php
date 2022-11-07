<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateWay extends Model
{
    use HasFactory;
    protected $table = 'payment_gateway';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
