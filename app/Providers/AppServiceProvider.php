<?php

namespace App\Providers;

use App\Services\Contracts\PaymentServiceInterface;
use App\Services\Payments\BoletoProcessorPaymentService;
use App\Services\Payments\CreditCardProcessorPaymentService;
use App\Services\Payments\PaymentProcessorFactory;
use App\Services\Payments\PixProcessorPaymentService;
use App\Services\PaymentService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(PaymentServiceInterface::class, PaymentService::class);

        PaymentProcessorFactory::registerProcessor('boleto', BoletoProcessorPaymentService::class);
        PaymentProcessorFactory::registerProcessor('pix', PixProcessorPaymentService::class);
        PaymentProcessorFactory::registerProcessor('credit_card', CreditCardProcessorPaymentService::class);
    }
}
