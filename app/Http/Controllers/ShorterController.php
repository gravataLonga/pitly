<?php

namespace App\Http\Controllers;

use App\Shorten;
use Illuminate\Http\Request;
use gravatalonga\ApiResponse;

class ShorterController extends Controller
{
    public function index(Request $request)
    {
        return (new ApiResponse(
            Shorten::withCount('stats'),
            10
        ))->fractal()->toJson();
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'url' => ['required', 'url']
        ]);

        $shorten = Shorten::create(request(['url']));

        if ($request->expectsJson()) {
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
