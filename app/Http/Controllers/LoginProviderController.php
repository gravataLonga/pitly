<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Contracts\Factory as Socialite;

class LoginProviderController extends Controller
{
    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
    }

    public function index()
    {
        return $this->socialite
            ->driver('github')
            ->scopes(['user:email'])
            ->redirect();
    }

    public function store()
    {
        $provider = $this->socialite->driver('github')->user();
        if (! User::where('email', $provider->getEmail())->exists()) {
            $user = User::create([
                'name' => $provider->getName(),
                'email' => $provider->getEmail(),
                'password' => bcrypt(str_random(12))
            ]);
        }

        auth()->login($user);
        return redirect()->route('home');
    }
}
