@extends('layouts.admin-app')

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
                                <h6 class="mb-3 tx-12 text-white">YOU EARNED</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="">
                                        <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $youEarned }}</h4>
                                        <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                                    </div>
                                    <span class="float-right my-auto ml-auto">
                                            @if($deltaEarned >= 0)
                                            <em class="fas fa-arrow-circle-up text-white"></em>
                                        @else
                                            <em class="fas fa-arrow-circle-down text-white"></em>
                                        @endif
											<span class="text-white op-7">{{ $deltaEarned }}</span>
										</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 d-inline-block">
                    <div class="card overflow-hidden sales-card bg-warning-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white js-current-time" id="currentTime"> {{ $currentTime }}</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <div class="" style="height: 45px;">
                                        <h4 class="tx-20 font-weight-bold mb-1 text-white"></h4>
                                        <p class="mb-0 tx-12 text-white op-7">Current time UTC</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-5 card d-inline-block float-left">
                        <div class="card-body">
                            <div
                                id="chart-timeline"
                                data-url="{{ route('admin.btc.api') }}"
                                data-sign="{{ $btcChange < 0 ? '-' : '+' }}"
                                data-diff="{{ abs($btcChange) }}"
                                data-current="{{ $currentPrice }}"
                                class="sales-bar mt-4"
                                data-prices="{{ json_encode($prices) }}"
                            ></div>
                            <div class="justify-content-center text-center" style="position: absolute; width: 90%; top: 81%;">
                                @foreach($dates as $date)
                                    <div
                                        class="mx-auto d-inline-block float-left"
                                        style="width: {{ 100/count($dates) }}%; color: #1098ff;"
                                    >{{ $date }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 card d-inline-block float-left offset-2">
                        <div class="card-body">
                            <h1>Bitcoin Price <br/> Predicted for {{ $nextUTCHour }}.00</h1>
                            <hr>
                            <div class="price" style="height: 90px; font-size: 30px;">
                                {{ $predictedPrice }} USD ($) {{ $predictedPriceChange }}% {{ $predictedPriceChange > 0 ? '↑' : '↓' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <!-- row opened -->
                    <div class="card">
                        <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mb-0">Order status</h4>
                                <em class="mdi mdi-dots-horizontal text-gray"></em>
                            </div>
                            <p class="tx-12 text-muted mb-0">
                                Order Status and Tracking. Track your order from ship date to arrival. To begin, enter your order number.
                            </p>
                        </div>
                        <div class="card-body" style="min-height: 100px;">
                            <div class="total-revenue">
                                <div>
                                    <h4>{{ $successOrders }}</h4>
                                    <label><span class="bg-primary"></span>success</label>
                                </div>
                                <div>
                                    <h4>{{ $pendingOrders }}</h4>
                                    <label><span class="bg-danger"></span>Pending</label>
                                </div>
                                <div>
                                    <h4>{{ $failedOrders }}</h4>
                                    <label><span class="bg-warning"></span>Failed</label>
                                </div>
                                <div>
                                    <h4>{{ $ordersTotal }}</h4>
                                    <label><span class="bg-dark"></span>Total</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Products preview</h4>
                    <!-- row opened -->
                    @foreach($subscriptionPlans as $subscriptionPlan)
                        <div class="col-sm-6 col-lg-6 col-xl-6 d-inline-block float-left p-0">
                            <div class="card align-content-center">
                                <div class="card-body text-center pricing">
                                    <div class="card-category"> {{ $subscriptionPlan->days }} Days Subscription</div>
                                    <div class="display-4 my-4">$ {{ number_format((float)$subscriptionPlan->price, 2, '.', '') }}</div>
                                    <ul class="list-unstyled leading-loose">
                                        <li><strong>{{ $subscriptionPlan->product->name }}</strong></li>
                                    </ul>
                                    <div class="text-center mt-4">
                                        <a
                                            href="{{ route('admin.subscription-plans.edit', $subscriptionPlan->id ) }}"
                                            class="btn btn-primary btn-block"
                                        >Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 p-0">
                @include('partials.charts.prediction-chart')
            </div>
        </div>
@endsection
