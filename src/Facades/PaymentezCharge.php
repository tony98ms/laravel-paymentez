<?php

namespace Blubear\LaravelPaymentez\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \stdClass create(string $token, array $order, array $user)
 * @method static \stdClass authorize(string $token, array $order, array $user)
 * @method static \stdClass capture(string $transactionId, float $amount = null)
 * @method static \stdClass verify(string $type, string $value, string $transactionId, array $user, bool $more_info = null)
 * @method static \stdClass refund(string $transactionId, float $amount = null)
 * @see \Paymentez\Resources\Card
 *
 */
class PaymentezCharge extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'paymentez-charge';
    }
}
