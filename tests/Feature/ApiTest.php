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
}
