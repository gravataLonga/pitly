<?php

namespace App\Http\Controllers;

use App\Shorten;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use App\Http\Controllers\Resources\ShortenTransform;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class ShorterController extends Controller
{
    public function index(Request $request)
    {
        $paginator = Shorten::withCount('stats')->paginate(10);
        $shorten = $paginator->getCollection();
        $fractal = new Manager();
        $resource = new Collection($shorten, new ShortenTransform, 'shorten');
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        // Turn all of that into a JSON string
        return $fractal->createData($resource)->toJson();
        return $shorten;
    }

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
