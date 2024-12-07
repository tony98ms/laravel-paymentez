<?php

namespace Blubear\LaravelPaymentez\Facades;

use Illuminate\Support\Facades\Facade;

class PaymentezCash extends  Facade
{

    protected static function getFacadeAccessor()
    {
        return 'paymentez-cash';
    }
}
