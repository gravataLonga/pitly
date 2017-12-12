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
        $shorten = Shorten::whereToken($token)->first();
        $shorten->stats()->create(['hit_at' => Carbon::now()]);
        return redirect($shorten->url);
    }
}
