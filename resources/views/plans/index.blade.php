@extends('layouts.nojs-app')

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
                        <div class="text-dark text-lg text-center mt-4">
                            {{ $plan->description }}
                        </div>
                        @auth
                        <div class="px-2 py-4 text-center mt-4">
                            <form action="{{ route('purchase.store', $plan->id) }}" method="POST">
                                <script
                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="{{ env('STRIPE_KEY') }}"
                                    data-amount="{{ $plan->amount }}"
                                    data-name="{{ $plan->name }}"
                                    data-description="{{ $plan->description }}"
                                    
                                    data-locale="auto"
                                    data-zip-code="true"
                                    data-purchase-button>
                                </script>
                                </form>
                        </div>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')

@endsection