<?php

namespace TonyStore\LaravelPaymentez\Enums;

enum StatusTransaction: string
{
    case SUCCESS = 'success';
    case FAILURE = 'failure';
    case PENDING = 'pending';
    case REFUND = 'refund';

    /**
     * Get the label for the given status value.
     *
     * @return string
     */

    public function label(): string
    {
        return static::getLabel($this);
    }

    /**
     * Get the label for the given status value.
     *
     * @param  self|string  $value
     * @return string
     */
    public static function getLabel(self|string $value): string
    {
        return match ($value) {
            self::PENDING => 'Pendiente',
            self::SUCCESS => 'Exitoso',
            self::FAILURE => 'Fallido',
            self::REFUND => 'Reembolso',
        };
    }
    /**
     * Get the status from the given string value.
     *
     * @param  string  $value
     * @return self
     */
    public static function fromString(string $value): self
    {
        return match ($value) {
            'pending' => self::PENDING,
            'success' => self::SUCCESS,
            'failure' => self::FAILURE,
            'refund' => self::REFUND,
        };
    }
}
