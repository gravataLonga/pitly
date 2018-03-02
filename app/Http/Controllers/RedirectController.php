<?php

namespace App\Http\Controllers;

use App\Stat;
use App\Shorten;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index($token)
    {
        return redirect(tap(Shorten::whereToken($token)->first(), function ($shorten) {
            $shorten->stats()->create(['hit_at' => Carbon::now()]);
        })->url);
    }
}
