<?php

namespace Tests\Feature;

use App\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function testAGuestCustomerCanViewTheRegistrationForm()
    {
        $this->get(route('register'))
            ->assertViewIs('customer.register')
            ->assertSuccessful()
            ->assertSeeText('Thank you for preferring our product');
    }

    public function testAAuthCustomerCannotViewTheRegistrationFormAndIsRedirectedToCarView()
    {
        $customer = factory(Customer::class)->create();

        $this->actingAs($customer, 'customer')
            ->get(route('register'))
            ->assertRedirect(route('customer.car'));
    }

    public function testAGuestCustomerCanViewTheRegistrationLogin()
    {
        $this->get(route('customer.login'))
            ->assertViewIs('customer.login')
            ->assertSuccessful()
            ->assertSeeText('Login user');
    }

    public function testAAuthCustomerCannotViewTheLoginFormAndIsRedirectedToCarView()
    {
        $customer = factory(Customer::class)->create();
        
        $this->actingAs($customer, 'customer')
            ->get(route('customer.login'))
            ->assertRedirect(route('customer.car'));
        }
        
    public function testARegisteredCustomerCanLoginAndIsRedirectedToCar()
    {
        $customer = factory(Customer::class)->create();
        
        $response = $this->post(route('customer.login'), [
            'email' => $customer->email,
            'password' => 'secret'
        ]);

        $response->assertRedirect(route('customer.car'));

    }

    public function testCanRegisterAsANewCustomer()
    {
        $userData = [
            'email' => 'jhondoe@gmail.com',
            'name' => 'Jhon Doe',
            'mobile' => '3120000000',
            'password' => 'secret'
        ];

        $this->post(route('customer.register'), $userData);
            //->assertRedirect(route('customer.car'));
        
        //$this->assertDatabaseHas('customers', ['email' => $userData['email']]);
        
    }
}
