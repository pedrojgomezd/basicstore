<?php

namespace Tests\Unit;

use App\Customer;
use App\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    public function testAPurchasesMustHaveACustomer()
    {
        $customer = factory(Customer::class)->create();

        $purchase = factory(Purchase::class)->create([
            'customer_id' => $customer->id
        ]);

        $this->assertEquals($customer->toArray(), $purchase->customer->toArray());
    }
}
