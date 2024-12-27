<?php

namespace TonyStore\LaravelPaymentez\Enums;

enum StatusDetail: int
{
    case WAITING_FOR_PAYMENT = 0;
    case VERIFICATION_REQUIRED = 1;
    case PAID_PARTIALLY = 2;
    case PAID = 3;
    case IN_DISPUTE = 4;
    case OVERPAID = 5;
    case FRAUD = 6;
    case REFUND = 7;
    case CHARGEBACK = 8;
    case REJECTED_BY_CARRIER = 9;
    case SYSTEM_ERROR = 10;
    case NUVEI_FRAUD = 11;
    case NUVEI_BLACKLIST = 12;
    case TIME_TOLERANCE = 13;
    case EXPIRED_BY_NUVEI = 14;
    case EXPIRED_BY_CARRIER = 15;
    case REJECTED_BY_NUVEI = 16;
    case ABANDONED_BY_NUVEI = 17;
    case ABANDONED_BY_CUSTOMER = 18;
    case INVALID_AUTHORIZATION_CODE = 19;
    case AUTHORIZATION_CODE_EXPIRED = 20;
    case NUVEI_FRAUD_PENDING_REFUND = 21;
    case INVALID_AUTH_CODE_PENDING_REFUND = 22;
    case AUTH_CODE_EXPIRED_PENDING_REFUND = 23;
    case NUVEI_FRAUD_REFUND_REQUESTED = 24;
    case INVALID_AUTH_CODE_REFUND_REQUESTED = 25;
    case AUTH_CODE_EXPIRED_REFUND_REQUESTED = 26;
    case MERCHANT_PENDING_REFUND = 27;
    case MERCHANT_REFUND_REQUESTED = 28;
    case ANNULLED = 29;
    case TRANSACTION_SEATED = 30;
    case WAITING_FOR_OTP = 31;
    case OTP_SUCCESSFULLY_VALIDATED = 32;
    case OTP_NOT_VALIDATED = 33;
    case PARTIAL_REFUND = 34;
    case THREEDS_METHOD_REQUESTED = 35;
    case THREEDS_CHALLENGE_REQUESTED = 36;
    case REJECTED_BY_3DS = 37;
    case FAILURE_CPF_VALIDATION = 47;
    case AUTHENTICATED_BY_3DS = 48;

    /**
     * Returns the label associated with the current status.
     *
     * @return string The human-readable label for the current status.
     */

    public function label(): string
    {
        return static::getLabel($this);
    }

    /**
     * Returns a human-readable label for the given status value.
     *
     * @param self|int $value The status value to get the label for. 
     *                        This can be an instance of the StatusDetail enum or an integer.
     * @return string The label corresponding to the provided status value.
     */

    public static function getLabel(self|int $value): string
    {
        return match ($value) {
            self::WAITING_FOR_PAYMENT => 'Esperando pago', // 0
            self::VERIFICATION_REQUIRED => 'Verificación requerida', // 1
            self::PAID_PARTIALLY => 'Pago parcial', // 2
            self::PAID => 'Pago', // 3
            self::IN_DISPUTE => 'En disputa', // 4
            self::OVERPAID => 'Pago excedido', // 5
            self::FRAUD => 'Fraude', // 6
            self::REFUND => 'Reembolso', // 7
            self::CHARGEBACK => 'Devolución', // 8
            self::REJECTED_BY_CARRIER => 'Rechazado por el transportista', // 9
            self::SYSTEM_ERROR => 'Error del sistema', // 10
            self::NUVEI_FRAUD => 'Fraude NUVEI', // 11
            self::NUVEI_BLACKLIST => 'Lista negra NUVEI', // 12
            self::TIME_TOLERANCE => 'Tolerancia de tiempo', // 13
            self::EXPIRED_BY_NUVEI => 'Expirado por NUVEI', // 14
            self::EXPIRED_BY_CARRIER => 'Expirado por el transportista', // 15
            self::REJECTED_BY_NUVEI => 'Rechazado por NUVEI', // 16
            self::ABANDONED_BY_NUVEI => 'Abandonado por NUVEI', // 17
            self::ABANDONED_BY_CUSTOMER => 'Abandonado por el cliente', // 18
            self::INVALID_AUTHORIZATION_CODE => 'Código de autorización inválido', // 19
            self::AUTHORIZATION_CODE_EXPIRED => 'Código de autorización caducado', // 20
            self::NUVEI_FRAUD_PENDING_REFUND => 'Fraude NUVEI pendiente de reembolso', // 21
            self::INVALID_AUTH_CODE_PENDING_REFUND => 'Código de autorización inválido pendiente de reembolso', // 22
            self::AUTH_CODE_EXPIRED_PENDING_REFUND => 'Código de autorización caducado pendiente de reembolso', // 23
            self::NUVEI_FRAUD_REFUND_REQUESTED => 'Fraude NUVEI solicitud de reembolso', // 24
            self::INVALID_AUTH_CODE_REFUND_REQUESTED => 'Código de autorización inválido solicitud de reembolso', // 25
            self::AUTH_CODE_EXPIRED_REFUND_REQUESTED => 'Código de autorización caducado solicitud de reembolso', // 26
            self::MERCHANT_PENDING_REFUND => 'Comercio pendiente de reembolso', // 27
            self::MERCHANT_REFUND_REQUESTED => 'Comercio solicitud de reembolso', // 28
            self::ANNULLED => 'Anulado', // 29
            self::TRANSACTION_SEATED => 'Transacción sentada', // 30
            self::WAITING_FOR_OTP => 'Esperando OTP', // 31
            self::OTP_SUCCESSFULLY_VALIDATED => 'OTP validado correctamente', // 32
            self::OTP_NOT_VALIDATED => 'OTP no validado', // 33
            self::PARTIAL_REFUND => 'Reembolso parcial', // 34
            self::THREEDS_METHOD_REQUESTED => '3DS método solicitado', // 35 (3DS)
            self::THREEDS_CHALLENGE_REQUESTED => '3DS desafío solicitado', // 36 (3DS)
            self::REJECTED_BY_3DS => 'Rechazado por 3DS', // 37 (3DS)
            self::FAILURE_CPF_VALIDATION => 'Error de validación de CPF', // 47
            self::AUTHENTICATED_BY_3DS => 'Autenticado por 3DS', // 48 (3DS)
            default => 'Desconocido',
        };
    }
}
