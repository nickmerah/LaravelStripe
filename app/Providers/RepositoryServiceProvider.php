<?php

namespace App\Providers;

use App\Interfaces\PaymentGatewayRepositoryInterface;
use App\Interfaces\PaymentMethodRepositoryInterface;
use App\Repositories\PaymentGatewayRepository;
use App\Repositories\PaymentMethodRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(PaymentGatewayRepositoryInterface::class, PaymentGatewayRepository::class);
        $this->app->bind(PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class);
    }


    public function boot()
    {
        //
    }
}
