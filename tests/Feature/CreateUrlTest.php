<?php

namespace Tests\Feature;

use App\Shorten;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUrlTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_submit_url ()
    {
        $url = 'http://www.google.pt';
        $this->post('shorter', ['url' => $url])
            ->assertRedirect('shorter');

        $this->assertDatabaseHas('shortens', [
            'url' => $url
        ]);
    }

    /** @test */
    public function after_created_can_access_shorten_url()
    {
        $shorten = factory(Shorten::class)->create([
            'url' => 'http://www.google.pt'
        ]);
        $this->get("s/{$shorten->token}")
            ->assertRedirect('http://www.google.pt');
    }

    /** @test */
    public function when_submit_the_url_must_be_valid ()
    {
        $this->post('shorter', ['url' => 'not-valid-url'])
            ->assertSessionHasErrors();

        $this->assertDatabaseMissing('shortens', [
            'url' => 'not-valid-url'
        ]);
    }
}
