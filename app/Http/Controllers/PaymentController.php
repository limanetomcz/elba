<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentPostRequest;
use App\Jobs\ProcessPayment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

    public function store(PaymentPostRequest $request)
    {
        $validated = $request->validated();
        ProcessPayment::dispatch($validated);
        return response()->json(['message' => 'Payment is being processed'], 202);
    }

    public function processPayment(array $validated)
    {
        try {
            $payment = Payment::create($validated);
            $payment->status = 'processed';
            $payment->save();
            Log::info('Payment processed successfully: ' . $payment->id);
        } catch (\Exception $e) {
            Log::error('Error processing payment: ' . $e->getMessage());
        }
    }
}
