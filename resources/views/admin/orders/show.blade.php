@extends('layouts.admin-app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Order #{{ $order->id }}</h1>

                @include('partials.order-body')
            </div>
        </div>
    </div>
@endsection
