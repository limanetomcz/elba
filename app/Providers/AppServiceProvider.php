<?php

namespace App\Providers;

use App\Services\Contracts\PaymentServiceInterface;
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
    }
}
