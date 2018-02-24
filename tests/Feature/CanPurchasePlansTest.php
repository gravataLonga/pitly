<?php

namespace Tests\Feature;

use App\Plan;
use App\User;
use Tests\TestCase;
use App\Billing\PaymentGateway;
use App\Billing\FakePaymentGateway;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CanPurchasePlansTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_see_plans_on_plans_page ()
    {
        $this->login();
        $plans = create(Plan::class, [], 3);

        $response = $this->get('/plans');

        $plans->fresh()->each(function($model) use ($response) {
            $response->assertSee($model->name);
        });
    }

    /** @test */
    public function show_correct_amount_to_price()
    {
        $this->login();
        create(Plan::class, ['amount' => 1230]);

        $this->get('/plans')
            ->assertSee('12,30€');
    }

    /** @test */
    public function only_authenticate_user_can_purchase_plans ()
    {
        $plans = factory(Plan::class, 1)->create();

        $this->get('/plans')
            ->assertDontSee('data-purchase-button')
            ->assertStatus(302);
    }

    /** @test */
    public function purchase_plan ()
    {
        $this->login();
        $this->withoutExceptionHandling();
        $paymentGateway = new FakePaymentGateway;
        $this->app->instance(PaymentGateway::class, $paymentGateway);
        $plan = create(Plan::class, ['amount' => 1500]);

        $response = $this->post("/purchase/{$plan->id}", [
            'token' => $paymentGateway->getValidTestToken()
        ]);

        $this->assertEquals(1500, $paymentGateway->totalCharges());
    }
}
