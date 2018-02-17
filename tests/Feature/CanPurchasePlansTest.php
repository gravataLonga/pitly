<?php

namespace Tests\Feature;

use App\Plan;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanPurchasePlansTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_see_plans_on_plans_page ()
    {
        $plans = factory(Plan::class, 3)->create();

        $response = $this->get('/plans');

        $plans->fresh()->each(function($model) use ($response) {
            $response->assertSee($model->name);
        });
    }

    /** @test */
    public function show_correct_amount_to_price()
    {
        $plans = factory(Plan::class, 1)->create(['amount' => 1230]);

        $response = $this->get('/plans');

        $response->assertSee('12,30€');
    }

    /** @test */
    public function only_authenticate_user_can_purchase_plans ()
    {
        $plans = factory(Plan::class, 1)->create();

        $response = $this->get('/plans');
        $response->assertDontSee('data-purchase-button');
    }

    /** @test */
    public function authenticated_user_can_see_purchase_button ()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $plans = factory(Plan::class, 1)->create();

        $response = $this->get('/plans');
        $response->assertSee('data-purchase-button');
    }
}
