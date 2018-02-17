<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function store(Request $request, $plan)
    {
        $user = auth()->user();
        $user->newSubscription('main', 'basic')->create($request->input('stripeToken'));
        return redirect(route('home'))->withSuccess('O seu plano foi actualizado');
    }
}
