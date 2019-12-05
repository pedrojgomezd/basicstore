<?php

namespace App\PlacetoPay;

use App\Purchase;

class Prepare
{
    public $request = [];

    public function request(Purchase $purchase)
    {
        $this->request = [
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

        return $this->request;
    }
}
