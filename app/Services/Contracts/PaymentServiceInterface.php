<?php

namespace App\Services\Contracts;

interface PaymentServiceInterface
{
    public function processPayment(array $data): void;
}
