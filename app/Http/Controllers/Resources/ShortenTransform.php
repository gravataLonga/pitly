<?php

namespace App\Http\Controllers\Resources;

use App\Shorten;
use League\Fractal\TransformerAbstract;

class ShortenTransform extends TransformerAbstract
{
    public function transform(Shorten $shorten)
    {
        return [
            'id'        => $shorten->id,
            'shorted'   => route('redirect.index', ['token' => $shorten->token]),
            'token'     => $shorten->token,
            'original'  => $shorten->url
        ];
    }
}
