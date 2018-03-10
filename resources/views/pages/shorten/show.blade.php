@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h1>{{ $shorten->token }}</h1>
        <p class="mt-2">{{ $shorten->url }}</p>
        <p class="text-grey-dark"><time>{{ $shorten->created }}</time></p>
    </div>
@endsection