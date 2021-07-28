@extends('layouts.admin-app')

@section('content')
    <div class="container">
        <div class="row row-sm">
            <div class="col-md-12 col-xl-12">
                <div class=" main-content-body-invoice">
                    <h1>
                        @if($invoice->status === \App\Models\Invoice::STATUS_NEW && time() < $invoice->expiration_time/1000)
                            Unpaid
                        @elseif($invoice->status === \App\Models\Invoice::STATUS_NEW && time() > $invoice->expiration_time/1000)
                            Expired
                        @endif
                        Invoice #{{ $invoice->id }}
                    </h1>

                    <div class="card card-invoice">
                        <div class="card-body">
                            <div class="invoice-header">
                                <h1 class="invoice-title">Invoice</h1>
                                <div class="billed-from">
                                    <p>Created At &nbsp; {{$invoice->created_at }}
                                    </p>
                                    <p>Updated At &nbsp; {{$invoice->updated_at }}
                                    </p>
                                </div><!-- billed-from -->
                            </div><!-- invoice-header -->
                            <div class="row mg-t-20">
                                <div class="col-md">
                                    <div class="billed-to">
                                        <h6>Buyer provided email:</h6>
                                        <p>{{ $invoice->buyer_provided_email}}</p>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label class="tx-gray-600">Invoice Information</label>
                                    <p class="invoice-info-row"><span>Created At:</span> {{ $invoice->created_at }}</p>
                                    <p class="invoice-info-row"><span>Updated At:</span> {{ $invoice->updated_at }}</p>
                                    <p class="invoice-info-row"><span>Status:</span> {{ $invoice->status }}</p>

                                </div>
                            </div>
                            {{--                         @if ($invoice->is_test) show <button type="button" class="btn btn-warning">Test invoice</button>--}}
                            <div class="table-responsive mg-t-40">
                                <table class="table table-invoice border text-md-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>External ID</th>
                                        <th>Currency</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ $invoice->id }}</td>
                                        <td>{{ $invoice->external_id }}</td>
                                        <td>{{ $invoice->currency }}</td>
                                        <td>{{ $invoice->price }}</td>
                                    </tr>
                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13">Notes</label>
                                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                            </div>
                                        </td><!-- invoice-notes -->
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse">Total Paid</td>
                                        <td class="tx-right" colspan="2">
                                            <h4 class="tx-primary tx-bold">{{ $invoice->transaction_currency.''.$invoice->amount_paid }}</h4>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr class="">
                            <div class="float-right">
                                @if($invoice->status === \App\Models\Invoice::STATUS_NEW && time() < $invoice->expiration_time/1000)
                                    <a
                                        href="{{ config('bit-pay.invoice_path').''.$invoice->external_id }}"
                                        target="_blank"
                                    >
                                        <input
                                            type="image"
                                            src="{{ asset('/assets/img/services/bit-pay/bp-btn-pay-currencies.svg') }}"
                                            name="submit"
                                            style="width: 210px"
                                            alt="BitPay, the easy way to pay with bitcoins."
                                        >
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- COL-END -->
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
@endsection
