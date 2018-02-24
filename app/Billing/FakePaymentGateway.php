<?php

namespace App\Billing;

class FakePaymentGateway implements PaymentGateway
{

    protected $charges;

    public function __construct()
    {
        $this->charges = collect();
    }

    public function charge($amount, $token)
    {
        $this->charges->push($amount);
    }

    public function getValidTestToken()
    {
        return 'valid-token';
    }

    public function totalCharges()
    {
        return $this->charges->sum();
    }
}