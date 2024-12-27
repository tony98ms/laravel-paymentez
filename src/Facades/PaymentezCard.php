<?php

namespace TonyStore\LaravelPaymentez\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \TonyStore\LaravelPaymentez\Response\Response getList(string|int $uid)
 * @method static \TonyStore\LaravelPaymentez\Response\Response delete(string $token, array $user)
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
