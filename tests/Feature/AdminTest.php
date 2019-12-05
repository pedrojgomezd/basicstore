<?php

namespace Tests\Feature;

use App\Purchase;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function routesThatRequireTheUserNotToBeAuthenticatedProvider()
    {
        return [
            ['login', 'admin']
        ];
    }
    
    /**
     * @dataProvider routesThatRequireTheUserNotToBeAuthenticatedProvider
     */
    public function test_routes_that_can_only_be_accessed_by_a_guest_user($route)
    {
        $this->get(route($route))
            ->assertSuccessful();
    }

    public function test_a_user_guest_cannot_access_to_route_admin()
    {
        $this->get(route('admin'))
            ->assertRedirect(route('login'));
    }

    public function test_as_user_auth_can_access_to_dashboard_and_see_purchases_list()
    {
        $user = factory(User::class)->create();

        factory(Purchase::class, 2)->create();

        $purchases = Purchase::with('customer')->get();

        $this->actingAs($user)
            ->get(route('admin'))
            ->assertViewIs('admin.dashboard')
            ->assertViewHasAll(['purchases' => $purchases]);
    }
}
