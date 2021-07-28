@extends('layouts.admin-app')

@section('content')
    <!-- container opened -->
    <div class="container-fluid">

        <!-- row -->
        <div class="row row-sm">

            <!-- Col -->
            <div class="col-lg-8">
                <div class="form-group mb-0 mt-3 justify-content-end mb-3">
                    <div class="navbar-header">
                        <a
                            class="navbar-brand btn btn-xm btn-primary"
                            href="{{ route('admin.products.index') }}"
                        ><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="card">
                    <form method="POST" class="form-horizontal" action="{{ route('admin.products.store') }}">
                        @csrf
                        @include('admin/products._form-content')
                    </form>
                </div>

            </div>
            <!-- /Col -->

        </div>
        <!-- row closed -->

    </div>
    <!-- Container closed -->
@endsection
