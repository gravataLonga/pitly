<?php

namespace Tests\Feature;

use App\Shorten;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUrlTest extends TestCase
{
    use RefreshDatabase;

    public function shortenUrl($params)
    {
        return $this->post('shorter', $params);
    }

    /** @test */
    public function can_submit_url ()
    {
        $url = 'http://www.google.pt';
        $this->shortenUrl(['url' => $url])
            ->assertRedirect('/');

        $this->assertDatabaseHas('shortens', [
            'url' => $url
        ]);
    }

    /** @test */
    public function after_created_can_access_shorten_url()
    {
        $shorten = create(Shorten::class, ['url' => 'http://www.google.pt']);
        $this->get("s/{$shorten->token}")
            ->assertRedirect('http://www.google.pt');
    }

    /** @test */
    public function when_submit_the_url_must_be_valid ()
    {
        $this->shortenUrl(['url' => 'not-valid-url'])
            ->assertSessionHasErrors();

        $this->assertDatabaseMissing('shortens', [
            'url' => 'not-valid-url'
        ]);
    }
}
