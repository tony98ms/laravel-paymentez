<?php

namespace TonyStore\LaravelPaymentez\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \TonyStore\LaravelPaymentez\Response\Response create(string $token, array $order, array $user)
 * @method static \TonyStore\LaravelPaymentez\Response\Response authorize(string $token, array $order, array $user)
 * @method static \TonyStore\LaravelPaymentez\Response\Response capture(string $transactionId, float $amount = null)
 * @method static \TonyStore\LaravelPaymentez\Response\Response verify(string $type, string $value, string $transactionId, array $user, bool $more_info = null)
 * @method static \TonyStore\LaravelPaymentez\Response\Response refund(string $transactionId, float $amount = null, bool $more_info = null)
 * @see \Paymentez\Resources\Charge
 *
 */
class PaymentezCharge extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'paymentez-charge';
    }
}
