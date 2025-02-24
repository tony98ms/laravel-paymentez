<?php

namespace TonyStore\LaravelPaymentez\Resources;

use Illuminate\Http\Client\RequestException;
use TonyStore\LaravelPaymentez\Response\Response;
use TonyStore\LaravelPaymentez\Resources\Resource;
use TonyStore\LaravelPaymentez\Exceptions\ResponseException;
use TonyStore\LaravelPaymentez\Exceptions\PaymentezErrorException;


class Cash extends Resource
{
    const GENERATE_ORDER_ENDPOINT = 'order';

    const ENDPOINTS = [
        self::GENERATE_ORDER_ENDPOINT => 'order/'
    ];

    /**
     * @param array $carrier
     * @param array $user
     * @param array $order
     * @return Response
     * @throws PaymentezErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws  \Illuminate\Http\Client\RequestException
     */
    public function generateOrder(
        array $carrier,
        array $user,
        array $order
    ): Response {
        $this->getRequestor()->validateRequestParams([
            'id' => 'string'
        ], $carrier);

        $this->getRequestor()->validateRequestParams([
            'id' => 'numeric',
            'email' => 'string'
        ], $user);

        $this->getRequestor()->validateRequestParams([
            'dev_reference' => 'string',
            'amount' => 'numeric',
            'expiration_days' => 'numeric',
            'recurrent' => 'bool',
            'description' => 'string'
        ], $order);

        try {
            $response = $this->getRequestor()->post(
                self::ENDPOINTS[self::GENERATE_ORDER_ENDPOINT],
                [
                    'carrier' => $carrier,
                    'user' => $user,
                    'order' => $order
                ],
                [],
                false
            );
        } catch (RequestException $clientException) {
            ResponseException::launch($clientException);
        }

        if ($response->ok()) {
            $this->setData($response);
            return $this->getData();
        }

        throw new PaymentezErrorException("Can't generate cash order.");
    }
}
