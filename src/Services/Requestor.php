<?php

namespace Blubear\LaravelPaymentez\Services;

use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\{Client, RequestOptions};
use Blubear\LaravelPaymentez\Exceptions\RequestException;
use Illuminate\Http\Client\Response;


class Requestor
{
    /**
     * @var Http
     */
    protected $client;

    /**
     * @var array
     */
    protected $request;

    /**
     * @var \StdClass
     */
    protected $response;

    /**
     * Requestor constructor.
     * @param array $apiUri
     * @param bool $production
     * @param string $authToken
     * @throws RequestException
     */
    public function __construct(string $baseUrl, bool $production)
    {
        $this->client = Http::withoutVerifying()
            ->acceptJson()
            ->contentType('application/json')
            ->withHeaders(self::mergeHeaders([
                'Auth-Token' => Autentication::token() // Generate new token for each request
            ]))
            ->baseUrl($baseUrl)
            ->throw()
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
