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
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $purchase->description }}</td>
                                    <td>{{ $purchase->amount_format }}</td>
                                    <td>{{ $purchase->status }}</td>
                                    <td>
                                        @if($purchase->status != 'PAYED')
                                            <button class="btn btn-success" onclick="
                                                document.getElementById('form-pay').action = '{{ route('payments.process', ['purchase' => $purchase]) }}'
                                                document.getElementById('form-pay').submit()
                                            ">
                                                Payment
                                            </button>
                                        @else
                                            {{$purchase->status}}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection