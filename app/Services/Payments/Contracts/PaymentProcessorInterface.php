<?php

namespace App\Services\Payments\Contracts;

use App\Models\Payment;

interface PaymentProcessorInterface
{
    public function process(Payment $payment): void;
}
