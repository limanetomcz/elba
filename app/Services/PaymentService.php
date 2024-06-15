<?php

namespace App\Services;

use App\Mail\PaymentFailMail;
use App\Mail\PaymentSuccessMail;
use App\Models\Payment;
use App\Services\Contracts\PaymentServiceInterface;
use App\Services\Payments\PaymentProcessorFactory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentService implements PaymentServiceInterface
{
    public function processPayment(array $data): void
    {
        try {
            $paymentMethod = $data['payment_method'];
            $processor = PaymentProcessorFactory::create($paymentMethod);
            $payment = Payment::create($data);
            $processor->process($payment);  
            //aqui eu devo ter o email do payer      
            Mail::to('recipient@example.com')->send(new PaymentSuccessMail($payment));    
            Log::info('Payment processed successfully: ' . $payment->id);
        } catch (\Exception $e) {
            Log::error('Error processing payment: ' . $e->getMessage());
            Mail::to('recipient@example.com')->send(new PaymentFailMail($payment));  
        }
    }
}