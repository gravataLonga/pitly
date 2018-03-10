<?php

namespace App\Http\Controllers;

use App\Shorten;
use Illuminate\Http\Request;
use gravatalonga\ApiResponse;

class ShorterController extends Controller
{
    /**
     * Listing Shorten Url
     */
    public function index()
    {
        return (new ApiResponse(
            Shorten::withCount('stats'),
            10
        ))->fractal()->toJson();
    }

    public function show($token)
    {
        $shorten = Shorten::where('token', $token)->first();
        return view('pages.shorten.show', compact('shorten'));
    }

    public function store()
    {
        $this->validate(request(), [
            'url' => ['required', 'url']
        ]);

        $shorten = Shorten::create(request(['url']));

        if (request()->expectsJson()) {
            return (new ApiResponse(
                $shorten,
                null
            ))->fractal()->toJson();
        }
        
        return redirect()
            ->route('home')
            ->withSuccess('Url encurtado com sucesso');
    }
}
