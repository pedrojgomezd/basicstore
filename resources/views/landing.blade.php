@extends('layouts.store')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center">Welcome to Basic Store</h2>
            <p class="text-center">The perfect pocket watch for you.</p>

            <div class="text-center">
                <div class="p-5">
                    <button class="btn btn-primary btn-block" onclick="document.getElementById('form-store').submit()">I WANT IT!</button>                    
                </div>
                <img src="/img/reloj.jpg" class="img-thumbnail" alt="">
            </div>
        </div>
    </div>
</div>

<form action="{{ route('purchases.store')}}" method="POST" id="form-store">
    @csrf
</form>
@endsection
