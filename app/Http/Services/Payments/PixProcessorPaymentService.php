<?php

namespace App\Services\Contracts\Payments;

use App\Models\Payment;
use App\Services\Payments\Contracts\PaymentProcessorInterface;
use Exception;

class PixProcessorPaymentService implements PaymentProcessorInterface
{
    public function process(Payment $payment): void
    {
        try {
            $payment->status = 'processed';
            $payment->save();
        } catch (Exception $e) {
            $payment->status = 'failed';
            $payment->save();
            throw new Exception("processed failed:" . $e->getMessage());
        }
    }
}
