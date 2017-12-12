<?php

namespace App\Http\Controllers;

use App\Stat;
use App\Shorten;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index($token)
    {
        $shorten = Shorten::with('stats')->where('token', $token)->first();
        return $shorten->stats;
    }
}
