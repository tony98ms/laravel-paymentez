<?php

namespace Blubear\LaravelPaymentez\Response;

use Illuminate\Http\Client\Response as ClientResponse;

class Response
{
    public function __construct(
        public ClientResponse $response,
    ) {}
    public static function make(ClientResponse $response): self
    {
        return new self($response);
    }
    /**
     * Returns the response as a PHP object.
     *
     * @return object
     */

    public function toObject(): object
    {
        return $this->response->object();
    }
    /**
     * Returns the response as a collection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function toCollection(): \Illuminate\Support\Collection
    {
        return $this->response->collect();
    }

    /**
     * Returns the response as a PHP array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->response->json();
    }

    /**
     * Returns the underlying `Illuminate\Http\Client\Response` instance.
     *
     * @return \Illuminate\Http\Client\Response
     */
    public function toResponse(): ClientResponse
    {
        return $this->response;
    }
}
