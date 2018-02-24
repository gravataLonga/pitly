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
        $plan = Plan::find($plan);
        $this->paymentGateway->charge($plan->amount, $request->input('token'));
    }
}
