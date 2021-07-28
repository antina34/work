<div class="container">
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">Order</h1>
                            <div class="billed-from">
                                <p>Created At &nbsp; {{ $order->created_at }}</p>
                                <p>Updated At &nbsp; {{ $order->updated_at }}</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md offset-md-7">
                                <label class="tx-gray-600">Order Information</label>
                                <p class="invoice-info-row"><span>Status:</span>{{ $order->status }}</p>

                            </div>
                        </div>
                        {{--                         @if ($invoice->is_test) show <button type="button" class="btn btn-warning">Test invoice</button>--}}
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User ID</th>
                                    <th>Product ID</th>
                                    <th>Subscription Plan ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user_id }}</td>
                                    <td>{{ $order->product_id }}</td>
                                    <td>{{ $order->subscription_plan_id }}</td>
                                </tr>
                                <tr>
                                    <td class="valign-middle" colspan="2" rowspan="4">
                                        <div class="invoice-notes">
                                            <label class="main-content-label tx-13">Notes</label>
                                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                        </div>
                                    </td><!-- invoice-notes -->
                                    <td class="tx-right tx-uppercase tx-bold tx-inverse">Price</td>
                                    <td class="tx-right" colspan="2">
                                        <h4 class="tx-primary tx-bold">{{$order->price }}</h4>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
</div>
