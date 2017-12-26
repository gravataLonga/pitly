@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap">
            @foreach($plans as $plan)
                <div class="w-1/3">
                    <div class="rounded shadow p-2 bg-white m-2 hover:bg-grey-lightest">
                        <div class="text-lg text-orange text-center font-sans">
                            {{ $plan->name }}
                        </div>
                        <div class="text-dark text-2xl text-center mt-4">
                            {{ $plan->price }}€
                        </div>
                        <div class="px-2 py-4 text-center mt-4">
                            <a href="#" class="border rounded border-pitly-dark bg-pitly text-black text-xs no-underline font-sans px-4 py-2">Comprar</a>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection