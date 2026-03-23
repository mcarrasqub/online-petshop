<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    
    use RefreshDatabase;

    /** @test */
    public function redirect_to_login_when_guest_visits_home()
    {
        $response = $this->get('/');
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function redirect_to_admin_home_when_admin_visits_home()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($admin)->get('/');
        $response->assertRedirect(route('admin.home.index'));
    }

    /** @test */
    public function redirect_to_product_index_when_user_visits_home()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $response = $this->actingAs($user)->get('/');
        $response->assertRedirect(route('product.index'));
    }
}