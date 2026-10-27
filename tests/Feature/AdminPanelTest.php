<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
    }

    public function test_authenticated_admin_can_access_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Admin Putri',
            'email' => 'admin@putribeautycare.com',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
    }

    public function test_authenticated_admin_can_access_manage_settings_page(): void
    {
        $admin = User::create([
            'name' => 'Admin Putri',
            'email' => 'admin@putribeautycare.com',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->get('/admin/manage-settings');

        $response->assertStatus(200);
    }

    public function test_inactive_user_cannot_access_admin_panel(): void
    {
        $inactive = User::create([
            'name' => 'Nonaktif',
            'email' => 'nonaktif@putribeautycare.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'is_active' => false,
        ]);

        $response = $this->actingAs($inactive)->get('/admin');

        $response->assertStatus(403);
    }
}
