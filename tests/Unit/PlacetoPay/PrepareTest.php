<?php

namespace Tests\Unit\PlacetoPay;

use App\PlacetoPay\Prepare;
use App\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PrepareTest extends TestCase
{
    public function test_reqeust_method_returns_aramid_header()
    {
        $purchase = factory(Purchase::class)->create();

        $prepare = new Prepare();

        $requestPrepare = $prepare->request($purchase);

        $request = [
            'payment' => [
                'reference' => $purchase->id,
                'description' => $purchase->description,
                'amount' => [
                    'currency' => 'COP',
                    'total' => $purchase->amount,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => route('payments.response', ['purchase' => $purchase]),
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
        ];

        $this->assertEquals($request, $requestPrepare);

    }
}
