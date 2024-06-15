<?php

namespace App\Services\Payments;

use App\Services\Contracts\Payments\BoletoProcessorPaymentService;
use App\Services\Contracts\Payments\CreditCardProcessorPaymentService;
use App\Services\Contracts\Payments\PixProcessorPaymentService;
use App\Services\Payments\Contracts\PaymentProcessorInterface;
use InvalidArgumentException;

class PaymentProcessorFactory
{
    public static function create(string $paymentMethod): PaymentProcessorInterface
    {
        return match ($paymentMethod) {
            'boleto' => new BoletoProcessorPaymentService(),
            'pix' => new PixProcessorPaymentService(),
            'credit_card' => new CreditCardProcessorPaymentService(),
            default => throw new InvalidArgumentException("Unsupported payment method: $paymentMethod"),
        };
    }
}
