<?php

namespace Tests\Feature;

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    public function test_can_view_orders()
    {
        $this->actingAs($this->user)
            ->get('/order')
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Dashboard/Order/Index')
                ->has('orders')
                ->has('orders.0', fn (Assert $assert) => $assert
                    ->etc()
                )
            );
    }
}