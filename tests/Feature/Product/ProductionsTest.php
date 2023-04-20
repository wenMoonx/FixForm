<?php

namespace Tests\Feature;

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProductionsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_can_view_productions()
    {
        $this->actingAs($this->user)
            ->get('/dashboard/products')
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Dashboard/Products/Index')
                ->has('posts.data')
                ->has('posts.data.0', fn (Assert $assert) => $assert
                    ->where('title', 'Aliquam et id qui sed.')
                    ->where('slug', 'et-ut-sed-dolor')
                    ->where('body', 'Perspiciatis et veniam non nemo ipsum repudiandae. Iste vel tempora rem veniam mollitia corporis. Voluptatem aspernatur in explicabo est minus. Voluptates perferendis error aliquid qui perferendis.
                    Vel laborum autem voluptatem iste. Optio et voluptatum aut. Culpa qui doloremque quis totam atque neque. Et qui sit voluptatum et rerum architecto magni.
                    Quod excepturi consequatur aut non velit. Dolor quia maiores molestiae alias.')
                    ->where('price', '1.00')
                    ->etc()
                )
            );
    }
}