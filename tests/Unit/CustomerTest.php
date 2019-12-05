<?php

namespace Tests\Unit;

use App\Customer;
use App\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;
    
    public function testACustomerCanHavePurchases()
    {
        $customer = factory(Customer::class)->create();

        $purchases = factory(Purchase::class, 5)->make([
            'customer_id' => $customer->id
        ]);

        $customer->purchases()->saveMany($purchases);

        $this->assertEquals($customer->purchases->toArray(), $purchases->toArray());
    }
}
