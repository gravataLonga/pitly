<?php

namespace Tests\Feature;

use App\Plan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanPurchasePlansTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_see_plans_on_plans_page ()
    {
        $this->withoutExceptionHandling();
        $plans = factory(Plan::class, 3)->create();

        $response = $this->get('/plans');

        $plans->fresh()->each(function($model) use ($response) {
            $response->assertSee($model->name);
            $response->assertSee($model->price);
        });
    }
}
