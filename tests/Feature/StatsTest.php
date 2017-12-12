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

    /** @test */
    public function can_retrive_stats_by_token ()
    {
        $shorten = factory(Shorten::class)->create();
        $stats = factory(Stat::class, 10)->create(['shorten_id' => $shorten->id]);
        $response = $this->getJson("api/shorten/stats/{$shorten->token}");
        $this->assertCount(10, $response->json());
    }
}
