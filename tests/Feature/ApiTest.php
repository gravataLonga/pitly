<?php

namespace Tests\Feature;

use App\Stat;
use App\Shorten;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_shorten_url_by_api ()
    {
        $this->postJson('api/shorten', ['url' => 'https://www.google.pt'])
            ->assertJsonStructure([
                'data' => [
                    'id', 
                    'shorted',
                    'token',
                    'original'
                ]
            ]);
    }

    /** @test */
    public function get_shortens_with_paginations()
    {
        $this->getJson('api/shorten')
            ->assertJsonStructure([
                'data',
                'meta' => [
                    'pagination' => [
                        'total',
                        'count',
                        'per_page',
                        'current_page',
                        'total_pages',
                        'links'
                    ]
                ]
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
