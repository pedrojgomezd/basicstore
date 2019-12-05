<?php

namespace Tests\Feature;

use App\Customer;
use App\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    public function test_a_purchese_can_payment_for_checkout()
    {
        $customer = factory(Customer::class)->create();

        $purchase = factory(Purchase::class)->create([
            'customer_id' => $customer->id
        ]);

        $this->actingAs($customer, 'customer')
            ->post(route('payments.process', ['purchase' => $purchase]));
            
        $this->assertNotNull($customer->purchases->first()->process_url);
        
        return $customer;
    }

    /**
     * @depends test_a_purchese_can_payment_for_checkout
     */
    public function test_change_purcahse_status_after_processing_payment($customer)
    {
        $purchase = $customer->purchases->first();

        $this->actingAs($customer, 'customer')
            ->get(route('payments.response', ['purchase' => $purchase]))
            ->assertRedirect(route('purchases.show', ['purchase' => $purchase]));

        $this->assertNotEquals('CREATED', $purchase->fresh()->status);
    }
}
