<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentPostRequest;
use App\Jobs\ProcessPaymentJob;
use App\Services\Contracts\PaymentServiceInterface;

class PaymentController extends Controller
{

    protected $paymentService;

    public function __construct(PaymentServiceInterface $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function store(PaymentPostRequest $request)
    {
        $validated = $request->validated();
        ProcessPaymentJob::dispatch($validated, $this->paymentService);
        return response()->json([
            "status" => "processing",
            "message" => "Payment request received and is being processed.",            
        ], 202);
    }

}
