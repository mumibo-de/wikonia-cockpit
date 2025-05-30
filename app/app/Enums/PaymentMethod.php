<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case PAYPAL = 'paypal';
    case STRIPE = 'stripe';
    case MANUAL = 'manual';

    public function label(): string
    {
        return match ($this) {
            self::PAYPAL => 'PayPal',
            self::STRIPE => 'Stripe',
            self::MANUAL => 'Vorkasse / Überweisung',
        };
    }
}
