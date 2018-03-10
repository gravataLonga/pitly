<?php

namespace Tests\Feature;

use App\Shorten;
use Carbon\Carbon;
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
        $this->shortenUrl(['url' => 'http://www.google.pt'])
            ->assertRedirect('/');

        $this->assertDatabaseHas('shortens', [
            'url' => 'http://www.google.pt'
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

    /** @test */
    public function has_details ()
    {
        $this->withoutExceptionHandling();
        $shorten = create(Shorten::class, ['url' => 'http://www.google.pt', 'created_at' => Carbon::parse('2018-03-04 00:00:00')]);

        $this->get("shorter/{$shorten->token}/detail")
            ->assertSuccessful()
            ->assertSee('http://www.google.pt')
            ->assertSee($shorten->token)
            ->assertSeeText('4 March, 2018');
    }
}
