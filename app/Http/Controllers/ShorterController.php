<?php

namespace App\Http\Controllers;

use App\Shorten;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Resources\ShortenTransform;

class ShorterController extends Controller
{
    public function store(Request $request)
    {
        // We can refactor this for Request Class and remove this.
        $this->validate(request(), [
            'url' => ['required', 'url']
        ]);

        $shorten = Shorten::create(request(['url']));

        if ($request->expectsJson()) {
            $fractal = new Manager();
            $resource = new Item($shorten, new ShortenTransform, 'shorten');
            // Turn all of that into a JSON string
            return $fractal->createData($resource)->toJson();
        }
        
        return redirect()->route('home')->withSuccess('Url encurtado com sucesso');
    }
}
