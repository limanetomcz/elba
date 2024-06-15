<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentPostRequest;
use App\Jobs\ProcessPayment;
use App\Models\Payment;
use App\Services\Payments\PaymentProcessorFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

    public function store(PaymentPostRequest $request)
    {
        $validated = $request->validated();
        ProcessPayment::dispatch($validated);
        return response()->json([
            "status" => "processing",
            "message" => "Payment request received and is being processed.",            
        ], 202);
    }

    public function processPayment(array $validated)
    {
        try {
            $paymentMethod = $validated['payment_method'];
            $processor = PaymentProcessorFactory::create($paymentMethod);
            $payment = Payment::create($validated);
            $processor->process($payment);            
            Log::info('Payment processed successfully: ' . $payment->id);
        } catch (\Exception $e) {
            Log::error('Error processing payment: ' . $e->getMessage());
        }
    }
}
