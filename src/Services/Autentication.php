<?php

namespace TonyStore\LaravelPaymentez\Services;

use DateTime;
use TonyStore\LaravelPaymentez\Exceptions\RequestException;

class Autentication
{
    /**
     * Generate string of authenticate
     * @return string
     * @throws \Exception
     */
    public static function token(): string
    {
        $code = config('paymentez.api_code');
        $apiKey = config('paymentez.api_key');
        if (empty($code) || empty($apiKey)) {
            throw new RequestException("Missing Paymentez API key or code, ensure that execute init method.");
        }

        $now = (string)(new DateTime)->getTimestamp();

        $uniqToken = implode('', [
            $apiKey,
            $now
        ]);

        $uniqTokenHash = hash('sha256', $uniqToken);

        return base64_encode(implode(';', [
            $code,
            $now,
            $uniqTokenHash
        ]));
    }
}
