<?php

namespace TonyStore\LaravelPaymentez\Services;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use TonyStore\LaravelPaymentez\Exceptions\RequestException;
use TonyStore\LaravelPaymentez\Exceptions\ResponseException;


class Requestor
{
    /**
     * @var Http
     */
    protected $client;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var \StdClass
     */
    protected $response;

    /**
     * Requestor constructor.
     * @param string $baseUrl
     * @param string $authToken
     * @throws RequestException
     */
    public function __construct(string $baseUrl)
    {
        $this->client = Http::withoutVerifying()
            ->baseUrl($baseUrl)
            ->beforeSending(function (Request $request,  $options) {
                $this->request = $request;
            })
            ->acceptJson()
            ->contentType('application/json')
            ->withHeaders(self::mergeHeaders([
                'Auth-Token' => Autentication::token() // Generate new token for each request
            ]))
            ->throw(function (Response $response, \Illuminate\Http\Client\RequestException $e) {
                ResponseException::launch($e,  $this->request);
            })
            ->timeout(config('paymentez.default_seconds_timeout'));
    }

    /**
     * @param string $resource
     * @param array $body
     * @param array $headers
     * @return mixed|\Illuminate\Http\Client\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(
        string $url,
        array $body,
        array $headers = [],
        bool $hasVersion = true
    ): Response {
        $resourcePath = [
            config('paymentez.api_version'),
            $url
        ];
        if (!$hasVersion) {
            array_shift($resourcePath);
        }
        $response = $this->client
            ->post(implode('/', $resourcePath), $body);
        return $response;
    }

    /**
     * @param string $resource
     * @param array $query
     * @param array $headers
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(
        string $url,
        array $query,
        array $headers = [],
        bool $hasVersion = true
    ): Response {
        $resourcePath = [
            config('paymentez.api_version'),
            $url
        ];
        if (!$hasVersion) {
            array_shift($resourcePath);
        }
        $response = $this->client
            ->get(
                implode('/', $resourcePath),
                $query
            );
        return $response;
    }
    /**
     * @param array $schema
     * @param array $params
     * @return bool
     * @throws RequestException
     */
    public function validateRequestParams(array $schema, array $params): bool
    {
        $validation = Helpers::validateArray($schema, $params);
        $total = $validation['errors']['total'];

        if ($total > 0) {
            logger("[Paymentez Requestor]: Errors on params validation.", $validation);
            throw new RequestException("Error on params validation see the logs for more information.");
        }

        return true;
    }

    /**
     * @param array $headers
     * @return array
     */
    public static function mergeHeaders(array $headers): array
    {
        return array_merge(config('paymentez.default_headers'), $headers);
    }
}
