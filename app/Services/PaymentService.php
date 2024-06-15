<?php

namespace App\Services;

use App\Models\Payment;
use App\Services\Contracts\PaymentServiceInterface;
use App\Services\Payments\PaymentProcessorFactory;
use Illuminate\Support\Facades\Log;

class PaymentService implements PaymentServiceInterface
{
    public function processPayment(array $data): void
    {
        try {
            $paymentMethod = $data['payment_method'];
            $processor = PaymentProcessorFactory::create($paymentMethod);
            $payment = Payment::create($data);
            $processor->process($payment);            
            Log::info('Payment processed successfully: ' . $payment->id);
        } catch (\Exception $e) {
            Log::error('Error processing payment: ' . $e->getMessage());
        }
    }
}