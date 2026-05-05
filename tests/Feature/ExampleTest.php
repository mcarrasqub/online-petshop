<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase

{

    use RefreshDatabase;

    /** @test */
    public function guest_can_visit_home_page()
    {
        $response = $this->get('/');
        $response->assertRedirect(route('login'));
    }


    /** @test */
    public function redirect_to_admin_home_when_admin_visits_home()

    {
        $admin = new User([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $admin->save();

        $response = $this->actingAs($admin)->get('/'); 
        $response->assertRedirect(route('admin.home.index'));
    }


    /** @test */
    public function regular_user_can_visit_home_page()

    {
        $user = new User([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        $user->save();

        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
    }
}