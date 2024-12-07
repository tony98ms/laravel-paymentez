<?php

namespace Blubear\LaravelPaymentez\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \stdClass getList(string|int $uid)
 * @method static \stdClass delete(string $token, array $user)
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
