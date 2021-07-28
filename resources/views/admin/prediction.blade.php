@extends('layouts.admin-app')

@section('content')
    <div class="container" xmlns="">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            @include('partials.charts.prediction-chart')
        </div>
    </div>
@endsection
