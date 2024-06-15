<?php

namespace App\Services\Payments;

use App\Services\Payments\Contracts\PaymentProcessorInterface;
use InvalidArgumentException;

class PaymentProcessorFactory
{
    protected static array $processors = [];

    public static function registerProcessor(string $paymentMethod, string $processorClass)
    {
        if (!is_subclass_of($processorClass, PaymentProcessorInterface::class)) {
            throw new InvalidArgumentException("Processor must implement PaymentProcessorInterface");
        }
        self::$processors[$paymentMethod] = $processorClass;
    }

    public static function create(string $paymentMethod): PaymentProcessorInterface
    {
        if (!isset(self::$processors[$paymentMethod])) {
            throw new InvalidArgumentException("Unsupported payment method: $paymentMethod");
        }
        $processorClass = self::$processors[$paymentMethod];
        return new $processorClass();
    }
}
