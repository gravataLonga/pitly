<?php

namespace Tests\Feature;

use App\Stat;
use App\Shorten;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function track_every_hit ()
    {
        $this->withoutExceptionHandling();
        $shorten = factory(Shorten::class)->create();
        $this->get("s/{$shorten->token}");

        $this->assertDatabaseHas('stats', [
            'hit_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'shorten_id' => $shorten->id
        ]);
    }
}
