<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Contracts\Factory as Socialite;

class ManagerAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticate_from_github_it_redirect ()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/login/github');
        $this->assertContains('github.com/login/oauth', $response->getTargetUrl());  
    }

    /** @test */
    public function authenticate_from_github_first_time_is_create_user ()
    {
        $this->mockSocialiteFacade([
            'id' => 1,
            'email' => 'me@jonatha.pt',
            'name' => 'Jonathan Fontes',
            'token' => 'token-github'
        ]);

        $this->get('/login/github/handle')
            ->assertRedirect('/');

        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'email' => 'me@jonatha.pt',
            'name' => 'Jonathan Fontes'
        ]);
    }

    /**
     * Mock the Socialite Factory, so we can hijack the OAuth Request.
     * @param  string  $email
     * @param  string  $token
     * @param  int $id
     * @return void
     */
    public function mockSocialiteFacade($attributes = [])
    {
        $socialiteUser = $this->createMock(\Laravel\Socialite\Two\User::class);
        $attributes = array_merge([
            'token' => 'token-provider',
            'id' => 1,
            'email' => 'johndoe@testing.com',
            'name' => 'John Doe',
            'avatar' => 'https://images.vexels.com/media/users/3/140749/isolated/preview/4fb58265f9e1ad8d8dd7c35f06fa58d6-avatar-perfil-masculino-1-by-vexels.png'
        ], $attributes);

        foreach ($attributes as $key => $value) {
            $socialiteUser->$key = $value;
        }

        $socialiteUser->method('getEmail')->willReturn($socialiteUser->email);
        $socialiteUser->method('getAvatar')->willReturn($socialiteUser->avatar);
        $socialiteUser->method('getId')->willReturn($socialiteUser->id);
        $socialiteUser->method('getNickname')->willReturn($socialiteUser->nickname);
        $socialiteUser->method('getName')->willReturn($socialiteUser->name);

        $provider = $this->createMock(\Laravel\Socialite\Two\GithubProvider::class);
        $provider->expects($this->any())
            ->method('user')
            ->willReturn($socialiteUser);

        $stub = $this->createMock(Socialite::class);
        $stub->expects($this->any())
            ->method('driver')
            ->willReturn($provider);

        $this->app->instance(Socialite::class, $stub);
    }
}
