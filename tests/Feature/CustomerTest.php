<?php

namespace Tests\Feature;

use App\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function routesThatRequireTheUserNotToBeAuthenticatedProvider()
    {
        return [
            ['register', 'landing'],
            ['customer.login', 'landing']
        ];
    }
    
    /**
     * @dataProvider routesThatRequireTheUserNotToBeAuthenticatedProvider
     */
    public function test_routes_that_can_only_be_accessed_by_a_guest_customer($route)
    {
        $this->get(route($route))
            ->assertSuccessful();
    }

    /**
     * @dataProvider routesThatRequireTheUserNotToBeAuthenticatedProvider
     */
    public function test_an_authenticated_customer_could_not_access_and_is_redirected($route, $redirect)
    {
        $customer = factory(Customer::class)->make();
        
        $this->actingAs($customer, 'customer')
        ->get(route($route))
        ->assertRedirect(route($redirect));
    }    
        
    public function test_a_registered_customer_can_login()
    {
        $customer = factory(Customer::class)->create();
        
        $response = $this->post(route('customer.login'), [
            'email' => $customer->email,
            'password' => 'secret'
        ]);

        $response->assertRedirect(route('landing'));

    }

    public function test_can_register_as_new_customer()
    {
        $userData = [
            'email' => 'jhondoe@gmail.com',
            'name' => 'Jhon Doe',
            'mobile' => '3120000000',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $this->post(route('customer.register'), $userData)
            ->assertRedirect(route('landing'));
        
        unset($userData['password']);
        unset($userData['password_confirmation']);
        
        $this->assertDatabaseHas('customers', $userData);
        
    }
}
