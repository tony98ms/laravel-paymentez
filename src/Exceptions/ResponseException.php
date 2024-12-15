<?php

namespace Blubear\LaravelPaymentez\Exceptions;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\RequestException;
use Blubear\LaravelPaymentez\Events\PaymentezErrorEvent;

class ResponseException
{

    /**
     * Throw a PaymentezErrorException with the message and code from the response error.
     * Also log the error with all the information if the logger param is true (default).
     * @param RequestException $clientException
     * @param Request|null $request
     * @param bool $logger
     * @throws PaymentezErrorException
     */
    public static function launch(RequestException $clientException, ?Request $request = null, bool $logger = true)
    {
        $response = $clientException->response;
        $errorPayload = $response->object();
        $rawResponse = $response->body();
        $help = $errorPayload->error->help;
        $desc = $errorPayload->error->description;
        $type = $errorPayload->error->type;
        $exceptionText = !empty($help) ? $help : $desc;
        $responseHttpCode = $response->status();

        if ($logger) {
            logger("=========== ERROR ON PAYMENTEZ API ===========");
            logger("Type of error: {$type}");
            logger("Description: {$desc}");
            logger("Some of help: {$help}");
            logger("HTTP code: {$responseHttpCode}");
            logger("Raw API response: {$rawResponse}");
            logger("Request: " . json_encode($request->data()));
            logger("Url: " . $request->url());
            logger("=========== // ERROR ON PAYMENTEZ API // ===========");
        }
        event(new PaymentezErrorEvent($type, $desc, $help, $responseHttpCode, $errorPayload, $request->url(), $request->data()));
        throw new PaymentezErrorException("$type: {$exceptionText}", $responseHttpCode);
    }
}
