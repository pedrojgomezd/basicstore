<?php

namespace App\Http\Controllers;

use App\Purchase;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $placetopay;

    public function __construct(PlacetoPay $placetopay) {
        $this->placetopay = $placetopay;
    }

    public function process(Purchase $purchase)
    {
        $reference = $purchase->id;

        $request = [
            'payment' => [
                'reference' => $reference,
                'description' => $purchase->description,
                'amount' => [
                    'currency' => 'COP',
                    'total' => $purchase->amount,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => config('app.url')."/payments/response/$reference",
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
        ];

        $response = $this->placetopay->request($request);

        if ($response->isSuccessful()) {
            $purchase->update([
                'request_id' => $response->requestId(),
                'process_url' => $response->processUrl()
            ]);

            return redirect($response->processUrl());
        } else {
            $response->status()->message();
        }
    }

    public function response(Purchase $purchase)
    {
        $response = $this->placetopay->query($purchase->request_id);

        $purchase->update([
            'status' => $response->status()->status() == 'APPROVED' ? 'PAYED' : 'REJECTED'
        ]);

        return redirect()->route('purchases.show', ['purchase' => $purchase]);
    }
}
