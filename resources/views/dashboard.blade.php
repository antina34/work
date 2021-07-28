@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 d-inline-block">
                <div class="card overflow-hidden sales-card bg-primary-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">TODAY REGISTERED</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $todayRegistered }}</h4>
                                    <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                                </div>
                                <span class="float-right my-auto ml-auto">
                                        @if($registrationsDelta >= 0)
                                            <em class="fas fa-arrow-circle-up text-white"></em>
                                        @else
                                            <em class="fas fa-arrow-circle-down text-white"></em>
                                        @endif
                                        <span class="text-white op-7">{{ $registrationsDelta }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 d-inline-block">
                <div class="card overflow-hidden sales-card bg-danger-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">TODAY SOLD</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $todaySold }}</h4>
                                    <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                                </div>
                                <span class="float-right my-auto ml-auto">
                                        @if($deltaSold >= 0)
                                            <em class="fas fa-arrow-circle-up text-white"></em>
                                        @else
                                            <em class="fas fa-arrow-circle-down text-white"></em>
                                        @endif
                                        <span class="text-white op-7">{{ $deltaSold }}</span>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 d-inline-block">
                <div class="card overflow-hidden sales-card bg-success-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">YOU BOUGHT</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $youBought }}</h4>
                                    <p class="mb-0 tx-12 text-white op-7">Since you are Registered</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 d-inline-block">
                <div class="card overflow-hidden sales-card bg-warning-gradient">
                    <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">YOU BOUGHT</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $youBought }}</h4>
                                    <p class="mb-0 tx-12 text-white op-7">Since you are Registered</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-12">
            <!-- row opened -->
            <div class="row">
                <!-- row opened -->
                @foreach($subscriptionPlans as $subscriptionPlan)
                    <div class="col-sm-6 col-lg-6 col-xl-6 d-inline-block float-left">
                        <div class="card align-content-center">
                            <div class="card-body text-center pricing">
                                <div class="card-category"> {{ $subscriptionPlan->days }} Days Subscription</div>
                                <div class="display-4 my-4">$ {{ number_format((float)$subscriptionPlan->price, 2, '.', '') }}</div>
                                <ul class="list-unstyled leading-loose">
                                    <li><strong>{{ $subscriptionPlan->product->name }}</strong></li>
                                </ul>
                                <div class="text-center mt-4">
                                    @if($subscriptionPlan->canBuy)
                                        <a href="{{  route('checkout', $subscriptionPlan->product) }}"  class="btn btn-primary btn-block">Buy Now</a>
                                    @else
                                        <p>You have active this subscription plan</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @foreach($products as $product)
            @if(!$product->canBuy)
                @php
                    $data = $predictionAndHistoricalData;
                @endphp
            @else
                @php
                    $data = $historicalData;
                @endphp
            @endif
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Chart</h4>
                    </div>

                    @foreach($data as $key => $value)
                        @if($product->id === $key)
                            <div class="card-body pt-0 mt-3">
                                <div
                                    class="js-chart"
                                    data-name="{{ $name[$key] }}"
                                    id="chart{{ $key }}"
                                    data-historical="{{ json_encode($value) }}"
                                    data-actual="{{ json_encode($actualData[$key]) }}"
                                    data-quantity="{{ $recordsToShow[$key] }}"
                                ></div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection
