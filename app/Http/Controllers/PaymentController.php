<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPayment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'payment_method' => 'required|string|in:boleto,pix,credit_card',
            'buyer_document' => 'required|string|max:11',
            'product_id' => 'required|string',
        ]);
        
        $payment = Payment::create($validated);

        ProcessPayment::dispatch($payment);

        return response()->json(['message' => 'Payment is being processed', 'payment' => $payment], 202);
    }
}
