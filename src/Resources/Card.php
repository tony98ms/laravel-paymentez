<?php

namespace Blubear\LaravelPaymentez\Resources;

use Illuminate\Http\Client\RequestException;
use Blubear\LaravelPaymentez\Response\Response;
use Blubear\LaravelPaymentez\Resources\Resource;
use Blubear\LaravelPaymentez\Exceptions\ResponseException;
use Blubear\LaravelPaymentez\Exceptions\PaymentezErrorException;

class Card extends Resource
{
    const LIST_ENDPOINT = 'list';
    const DELETE_ENDPOINT = 'delete';

    const ENDPOINTS = [
        self::LIST_ENDPOINT => "card/list",
        self::DELETE_ENDPOINT => "card/delete/"
    ];

    /**
     * @param string $token
     * @param array $user
     * @return Response
     * @throws PaymentezErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function delete(string $token, array $user): Response
    {
        $card = [
            'token' => $token
        ];

        $this->getRequestor()->validateRequestParams([
            'token' => 'string'
        ], $card);

        $this->getRequestor()->validateRequestParams([
            'id' => 'numeric'
        ], $user);

        try {
            $response = $this->getRequestor()->post(self::ENDPOINTS[self::DELETE_ENDPOINT], [
                'card' => $card,
                'user' => $user
            ]);
        } catch (RequestException $exception) {
            ResponseException::launch($exception);
        }

        if ($response->ok()) {
            $this->setData($response);
            return $this->getData();
        }

        throw new PaymentezErrorException("Error on delete card.");
    }

    /**
     * @param $uid
     * @return Response
     * @throws PaymentezErrorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getList(string|int $uid): Response
    {
        $params = ['uid' => (string)$uid];
        $this->getRequestor()->validateRequestParams([
            'uid' => 'numeric'
        ], $params);

        try {
            $response = $this->getRequestor()->get(self::ENDPOINTS[self::LIST_ENDPOINT], $params);
        } catch (RequestException  $clientException) {
            ResponseException::launch($clientException);
        }

        if ($response->ok()) {
            $this->setData($response);
            return $this->getData();
        }

        throw new PaymentezErrorException(
            __('Error on get list of cards.')
        );
    }
}
