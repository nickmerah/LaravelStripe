<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentGateway extends Migration
{

    public function up()
    {
        Schema::create('payment_gateway', function (Blueprint $table) {
            $table->id();
            $table->string('pgname');
            $table->string('pgdescription');
            $table->integer('isActive');
            $table->timestamps();
        });
    }


    public function down()
    {
        //
    }
}
