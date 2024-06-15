<?php

namespace App\Jobs;

use App\Http\Controllers\PaymentController;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $validatedData;


    /**
     * Create a new job instance.
     *
     * @param  array  $validatedData
     * @return void
     */
    public function __construct(array $validatedData)
    {
        $this->validatedData = $validatedData;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $controller = new PaymentController();
        $controller->processPayment($this->validatedData);
    }
}
