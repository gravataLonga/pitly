@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <shorten-component url="api/shorten"></shorten-component>
    </div>
@endsection