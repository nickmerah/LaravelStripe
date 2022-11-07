<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentMethods extends Migration
{

    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('pname');
            $table->string('pdescription');
            $table->tinyInteger('setdefault')->default('0');
            $table->float('pcharges');
            $table->timestamps();
        });
    }


    public function down()
    {
        //
    }
}
