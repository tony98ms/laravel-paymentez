<?php

namespace Blubear\LaravelPaymentez\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Blubear\LaravelPaymentez\Response\Response generateOrder(array $carrier, array $user, array $order)
 * @see \Paymentez\Resources\Cash
 *
 */
class PaymentezCash extends  Facade
{

    protected static function getFacadeAccessor()
    {
        return 'paymentez-cash';
    }
}
