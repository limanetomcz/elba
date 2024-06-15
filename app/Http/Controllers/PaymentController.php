<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentPostRequest;
use App\Jobs\ProcessPayment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
   
    public function store(PaymentPostRequest $request)
    {
        $validated = $request->validated();
        
        $payment = Payment::create($validated);

        ProcessPayment::dispatch($payment);

        return response()->json(['message' => 'Payment is being processed', 'payment' => $payment], 202);
    }
}
