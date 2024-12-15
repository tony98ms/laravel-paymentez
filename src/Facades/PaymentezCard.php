<?php

namespace Blubear\LaravelPaymentez\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Blubear\LaravelPaymentez\Response\Response getList(string|int $uid)
 * @method static \Blubear\LaravelPaymentez\Response\Response delete(string $token, array $user)
 *
 * @see \Paymentez\Resources\Card
 *
 */
class PaymentezCard extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'paymentez-card';
    }
}
