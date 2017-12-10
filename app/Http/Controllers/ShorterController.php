<?php

namespace App\Http\Controllers;

use App\Shorten;
use Illuminate\Http\Request;

class ShorterController extends Controller
{
    public function store()
    {
        // We can refactor this for Request Class and remove this.
        $this->validate(request(), [
            'url' => ['required', 'url']
        ]);
        Shorten::create(request(['url']));
        return redirect()->route('shorter.index');
    }
}
