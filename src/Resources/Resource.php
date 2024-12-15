<?php

namespace Blubear\LaravelPaymentez\Resources;

use Blubear\LaravelPaymentez\Response\Response;
use Blubear\LaravelPaymentez\Services\Requestor;
use Blubear\LaravelPaymentez\Exceptions\ResourceException;


abstract class Resource
{
    /**
     * @var object
     */
    private $data;

    /**
     * @var Requestor
     */
    private $requestor;

    /**
     * Resource constructor.
     * @param Requestor $requestor
     */
    public function __construct(Requestor $requestor)
    {
        $this->requestor = $requestor;
    }

    /**
     * @param $name
     * @return mixed
     * @throws ResourceException
     */
    public function __get($name)
    {
        if (!property_exists($this->data, $name)) {
            throw new ResourceException("Undefined property with name {$name}.");
        }

        return $this->data->$name;
    }

    /**
     * @param \Illuminate\Http\Client\Response $response
     * @return Resource
     */
    protected function setData(\Illuminate\Http\Client\Response $response): self
    {
        $this->data = Response::make($response);
        return $this;
    }

    /**
     * @return Response
     */
    public function getData(): Response
    {
        return $this->data;
    }

    /**
     * @return Requestor
     */
    public function getRequestor(): Requestor
    {
        return $this->requestor;
    }
}
