<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

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
}
