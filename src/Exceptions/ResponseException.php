<?php

namespace Blubear\LaravelPaymentez\Exceptions;

use Illuminate\Http\Client\RequestException;


class ResponseException
{
    /**
     * @param ClientException $clientException
     * @param bool $logger
     * @return void
     * @throws PaymentezErrorException
     */
    public static function launch(RequestException $clientException, bool $logger = true)
    {
        $error = $clientException->getResponse();
        $rawResponse = $error->getBody()->getContents();
        $errorPayload = json_decode($rawResponse);
        $help = $errorPayload->error->help;
        $desc = $errorPayload->error->description;
        $type = $errorPayload->error->type;
        $exceptionText = !empty($help) ? $help : $desc;
        $responseHttpCode = $clientException->getCode();

        if ($logger) {
            logger("=========== ERROR ON PAYMENTEZ API ===========");
            logger("Type of error: {$type}");
            logger("Description: {$desc}");
            logger("Some of help: {$help}");
            logger("HTTP code: {$responseHttpCode}");
            logger("Raw API response: {$rawResponse}");
            logger("=========== // ERROR ON PAYMENTEZ API // ===========");
        }

        throw new PaymentezErrorException("[{$type}]: {$exceptionText}", $responseHttpCode);
    }
}
