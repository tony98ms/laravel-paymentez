<?php

namespace Blubear\LaravelPaymentez\Enums;

enum VerifyType: string
{
    case BY_AMOUNT = 'BY_AMOUNT';
    case BY_AUTH_CODE = 'BY_AUTH_CODE';
    case BY_OTP = 'BY_OTP';
    case BY_CRES = 'BY_CRES';
    case AUTHENTICATION_CONTINUE = 'AUTHENTICATION_CONTINUE';
}
