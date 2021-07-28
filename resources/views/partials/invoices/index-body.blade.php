<!-- container -->
<div class="container-fluid">

    <!-- row opened -->
    <div class="row row-sm">

        <!--div-->
        <div class="col-xl-12">
            @if(count($invoices))
                <div class="card mg-b-20">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">{{ $tableTitle }}</h4>
                            <em class="mdi mdi-dots-horizontal text-gray"></em>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">
                                <caption></caption>
                                <thead>
                                <tr>
                                    <th class="border-bottom-0" scope="col">ID</th>
                                    <th class="border-bottom-0" scope="col">External ID</th>
                                    <th class="border-bottom-0" scope="col">Currency</th>
                                    <th class="border-bottom-0" scope="col">Price</th>
                                    <th class="border-bottom-0" scope="col">Is a test invoice?</th>
                                    <th class="border-bottom-0" scope="col">Status</th>
                                    <th class="border-bottom-0" scope="col">Invoice Time</th>
                                    <th class="border-bottom-0" scope="col">Expiration Time</th>
                                    <th class="border-bottom-0" scope="col">Current Time</th>
                                    <th class="border-bottom-0" scope="col">Buyer Provided Email</th>
                                    <th class="border-bottom-0" scope="col">Transaction Currency</th>
                                    <th class="border-bottom-0" scope="col">Amount Paid</th>
                                    <th class="border-bottom-0" scope="col">Created At</th>
                                    <th class="border-bottom-0" scope="col">Updated At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $invoice)
                                    @if($invoice)
                                        <tr>
                                            <td>
                                                @if($showingAsAdmin ?? false)
                                                    <a href="{{ route('admin.invoices.show', $invoice->id ) }}">
                                                        <span>{{ $invoice->id }}</span>
                                                    </a>
                                                @else
                                                    <a href="{{ route('invoices.show', $invoice->id ) }}">
                                                        <span>{{ $invoice->id }}</span>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $invoice->external_id }}</td>
                                            <td>{{ $invoice->currency }}</td>
                                            <td>{{ $invoice->price }}</td>
                                            <td>{{ $invoice->is_test }}</td>
                                            <td>{{ $invoice->status }}</td>
                                            <td>{{ $invoice->formatDateTime($invoice->invoice_time/1000) }}</td>
                                            <td>{{ $invoice->formatDateTime($invoice->expiration_time/1000) }}</td>
                                            <td>{{ $invoice->formatDateTime($invoice->current_time_string/1000) }}</td>
                                            <td>{{ $invoice->buyer_provided_email }}</td>
                                            <td>{{ $invoice->transaction_currency }}</td>
                                            <td>{{ $invoice->amount_paid }}</td>
                                            <td>{{ $invoice->created_at }}</td>
                                            <td>{{ $invoice->updated_at }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <p>You do not have any invoices yet.</p>
            @endif
        </div>
        <!--/div-->

    </div>
    <!-- /row -->
</div>
<!-- Container closed -->
