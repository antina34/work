@extends('layouts.admin-app')

@section('content')
    <!-- container -->
    <div class="container-fluid">

        <!-- row opened -->
        <div class="row row-sm">

            <!--div-->
            <div class="col-xl-12">
                @if(count($orders))
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
                                        <th class="border-bottom-0" scope="col">Date</th>
                                        <th class="border-bottom-0" scope="col">Price</th>
                                        <th class="border-bottom-0" scope="col">User Id</th>
                                        <th class="border-bottom-0" scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        @if($order)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.orders.show', $order->id) }}">
                                                        {{ $order->id }}
                                                    </a>
                                                </td>
                                                <td>{{ $order->date_formatted }}</td>
                                                <td>€{{ $order->price }}</td>
                                                <td>{{ $order->user_id }}</td>
                                                <td>{{ $order->status }}</td>
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
@endsection
