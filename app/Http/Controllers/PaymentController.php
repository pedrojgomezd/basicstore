<?php

namespace App\Http\Controllers;

use App\PlacetoPay\Prepare;
use App\Purchase;
use Dnetix\Redirection\PlacetoPay;

class PaymentController extends Controller
{
    protected $placetopay;
    protected $prepare;

    public function __construct(PlacetoPay $placetopay, Prepare $prepare) {
        $this->placetopay = $placetopay;        
        $this->prepare = $prepare;        
    }

    public function process(Purchase $purchase)
    {
        $response = $this->placetopay->request($this->prepare->request($purchase));

        if ($response->isSuccessful()) {
            $purchase->update([
                'request_id' => $response->requestId(),
                'process_url' => $response->processUrl()
            ]);
            return redirect($response->processUrl());
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
