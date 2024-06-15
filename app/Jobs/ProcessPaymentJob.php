<?php

namespace App\Jobs;

use App\Services\PaymentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $validatedData;
    protected $paymentService;

    /**
     * Create a new job instance.
     *
     * @param  array  $validatedData
     * @param  PaymentService  $paymentService
     * @return void
     */
    public function __construct(array $validatedData, PaymentService $paymentService)
    {
        $this->validatedData = $validatedData;
        $this->paymentService = $paymentService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->paymentService->processPayment($this->validatedData);
    }
}
