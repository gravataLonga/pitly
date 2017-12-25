@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-1/2 border p-2 rounded">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="flex mb-2">
                    <label for="name" class="bg-white rounded-l border-t border-l border-b font-sans text-base py-2 px-2 w-1/3 text-right">name</label>
                    <input id="name" type="text" class="px-2 py-2 border rounded-r w-2/3" name="name" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="flex mb-2">
                    <label for="email" class="bg-white rounded-l border-t border-l border-b font-sans text-base py-2 px-2 w-1/3 text-right">e-mail</label>
                    <input id="email" type="email" class="px-2 py-2 border rounded-r w-2/3" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="flex mb-2">
                    <label for="password" class="bg-white rounded-l border-t border-l border-b font-sans text-base py-2 px-2 w-1/3 text-right">password</label>
                    <input id="password" type="password" class="px-2 py-2 border rounded-r w-2/3" name="password" required>
                </div>

                <div class="flex mb-2">
                    <label for="password-confirm" class="bg-white rounded-l border-t border-l border-b font-sans text-base py-2 px-2 w-1/3 text-right">confirm</label>
                    <input id="password-confirm" type="password" class="px-2 py-2 border rounded-r w-2/3" name="password_confirmation" required>
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="bg-white text-center text-black px-4 py-2 rounded no-underline font-sans border hover:bg-grey-lightest text-xs">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
