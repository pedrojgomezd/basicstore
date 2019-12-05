@extends('layouts.store')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        Details purchase
                    </div>
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Estatus</th>
                                    <th>Payment</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $purchase)                                        
                                    <tr>
                                        <td>{{ $purchase->description }}</td>
                                        <td>{{ $purchase->amount_format }}</td>
                                        <td>{{ $purchase->status }}</td>
                                        <td>Status</td>
                                        <td>
                                            <a href="{{ route('purchases.show', ['purchase' => $purchase]) }}">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection