@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-1/4 border p-2 rounded bg-grey-lightest">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="mb-2 flex">
                    <label for="email" class="bg-white rounded-l border-t border-l border-b font-sans text-base py-2 px-2 w-1/3 text-right">e-mail</label><input id="email" type="email" class="px-2 py-2 border rounded-r w-2/3" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="mb-2 flex">
                    <label for="password" class="bg-white rounded-l border-t border-l border-b font-sans text-base py-2 px-2 w-1/3 text-right">password</label>
                    <input id="password" type="password" class="px-2 py-2 border rounded-r  w-2/3" name="password" required>
                </div>
                <div>
                    <label class="font-sans text-black text-sm flex mb-2 items-center justify-center">
                        <input class="mr-2" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="bg-pitly text-center text-black px-4 py-2 rounded-l no-underline font-sans border-l border-t border-b hover:bg-grey-lightest text-xs">
                        Login
                    </button>

                    <a class="bg-white text-center text-black px-4 py-2 rounded-r no-underline font-sans border hover:bg-grey-lightest text-xs" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </div>
                <hr class="mt-4">
                <h3 class="text-center">Ou</h3>
                <hr class="mt-4">
                <div class="text-center mb-4">
                    <a href="{{ route('login.provider.index') }}" class="bg-white text-center text-black px-4 py-2 no-underline font-sans border hover:bg-grey-lightest text-xs">Entrar com Github</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
