<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ExampleTest extends TestCase

{

    use RefreshDatabase;

    #[Test]
    public function redirect_to_login_when_guest_visits_home()
    {
        $response = $this->get('/');
        $response->assertRedirect(route('login'));
    }


    #[Test]
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


    #[Test]
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
        $response->assertRedirect(route('product.index'));
    }
}

