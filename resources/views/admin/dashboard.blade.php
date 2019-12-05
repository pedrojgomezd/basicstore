@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">Purchases List</div>
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $purchase->customer->name }}</td>
                                        <td>{{ $purchase->description }}</td>
                                        <td>{{ $purchase->Amount_format }}</td>
                                        <td>{{ $purchase->customer->email }}</td>
                                        <td>{{ $purchase->customer->mobile }}</td>
                                        <td class="{{ $purchase->status_color }}">{{ $purchase->status }}</td>
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