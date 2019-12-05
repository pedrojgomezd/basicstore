<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Dnetix\Redirection\PlacetoPay;

class PlacetoPayTest extends TestCase
{
    public function test_to_instantiate_the_place_must_receive_config_parameters_from_the_provider_and_response_successful()
    {
        $placetopay = resolve(PlacetoPay::class);

        $reference = \Str::random(10).'-compra';

        $request = [
            'payment' => [
                'reference' => $reference,
                'description' => 'Testing payment',
                'amount' => [
                    'currency' => 'COP',
                    'total' => 120000,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => 'http://storebasic.test/response?reference=' . $reference,
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
        ];

        $response = $placetopay->request($request);

        $this->assertTrue($response->isSuccessful());
    }
}
