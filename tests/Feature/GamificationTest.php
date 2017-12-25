<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GamificationTest extends TestCase
{
    /** @test */
    public function if_not_have_any_url_can_see_custom_text ()
    {
        $this->get('/')
            ->assertSee(trans('form.create_your_first_one'));
    }
}
