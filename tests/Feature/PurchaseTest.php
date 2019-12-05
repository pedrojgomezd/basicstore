<?php

namespace Tests\Feature;

use App\Customer;
use App\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_a_guest_customuer_cannot_make_a_purchase_and_us_redirected_to_the_register_form()
    {
        $this->post(route('purchases.store'))
            ->assertRedirect(route('customer.login'));
    }

    public function test_a_authenticated_customer_can_make_a_purchase_and_view_details()
    {
        $customer = factory(Customer::class)->create();

        $response = $this->actingAs($customer, 'customer')
            ->post(route('purchases.store'));
        
        $this->assertDatabaseHas('purchases', [
            'customer_id' => $customer->id,
            'description' => 'Luxury pocket watch',
            'amount'      => 1200000,
            'status'      => 'CREATED'
        ]);

        $purchase = $customer->purchases;
        
        $response->assertRedirect($route = route('purchases.show', ['purchase' => $purchase->first()]));

        return $customer;
    }

    public function test_a_customer_can_see_the_history_of_their_orders()
    {
        $customer = factory(Customer::class)->create();

        $purchases = factory(Purchase::class, 5)->create([
            'customer_id' => $customer->id
        ]);

        $this->actingAs($customer, 'customer')
            ->get(route('purchases.index'))
            ->assertSuccessful()
            ->assertViewHas('purchases', $customer->purchases);

    }

    public function test_a_authenticated_customer_can_see_details_purchase()
    {
        $customer = factory(Customer::class)->create();

        $purchase = factory(Purchase::class)->create([
            'customer_id' => $customer->id
        ]);

        $this->actingAs($customer, 'customer')
            ->get(route('purchases.show', ['purchase' => $purchase]))
            ->assertViewHas('purchase', $purchase)
            ->assertSeeText('Details purchase');
    }

    public function test_a_custeomer_can_cancel_his_order_before_paying_for_it()
    {
        $customer = factory(Customer::class)->create();

        $purchase = factory(Purchase::class)->create([
            'customer_id' => $customer->id
        ]);

        $response = $this->actingAs($customer, 'customer')
                        ->delete(route('purchases.destroy', ['purchase' => $purchase]));
        
        $this->assertDatabaseMissing('purchases', $purchase->toArray());

        $response->assertRedirect('/');
    }
}
