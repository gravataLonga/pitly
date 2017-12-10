<?php

namespace App\Http\Controllers;

use App\Shorten;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index($token)
    {
        return redirect(Shorten::whereToken($token)->first()->url);
    }
}
