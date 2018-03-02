<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;
use App\Billing\PaymentGateway;

class PurchaseController extends Controller
{
    protected $paymentGateway;

    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function store(Request $request, $plan)
    { 
        tap(Plan::find($plan), function ($plan) use ($request) {
            $this->paymentGateway->charge($plan->amount, $request->input('token'));
        });
    }
}
