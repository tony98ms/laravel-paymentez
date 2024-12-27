<?php

namespace TonyStore\LaravelPaymentez\Enums;

enum Status: int
{
    case PENDING = 0;
    case APPROVED = 1;
    case CANCELLED = 2;
    case REJECTED = 4;
    case EXPIRED = 5;

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
     * @param  self|int  $value
     * @return string
     */
    public static function getLabel(self|int $value): string
    {
        return match ($value) {
            self::PENDING => 'Pendiente', // 0
            self::APPROVED => 'Aprobado', // 1
            self::CANCELLED => 'Cancelado', // 2
            self::REJECTED => 'Rechazado', // 4
            self::EXPIRED => 'Expirado', // 5
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
            'pending' => self::PENDING, // 0
            'success' => self::APPROVED, // 1
            'failure' => self::REJECTED, // 4
        };
    }
}
