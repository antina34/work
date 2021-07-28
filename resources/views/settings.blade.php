@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- row -->
                <div class="row row-sm">
                    <div class="col-lg-4">
                        <div class="card mg-b-20" style="min-height: 112px;">
                            <div class="card-body">
                                <div class="pl-0">
                                    <div class="main-profile-overview">
                                        <div class="d-flex justify-content-between mg-b-20">
                                            <div>
                                                @if($user->google_avatar_url)
                                                    <div class="main-img-user profile-user">
                                                        <img alt="" src="{{ $user->google_avatar_url }}">
                                                        {{-- <a class="fas fa-camera profile-edit" href="JavaScript:void(0);"></a>--}}
                                                    </div>
                                                @endif
                                                <h5 class="main-profile-name">{{ $user->name }}</h5>
                                                <p class="main-profile-name-text">Member
                                                    since {{ $user->created_at }}</p>
                                            </div>
                                        </div>
                                        {{-- if user has social login--}}
                                        @if($user->google_id)
                                            <hr class="mg-y-30">
                                            <label class="main-content-label tx-13 mg-b-20">Gmail</label>
                                            <div class="main-profile-social-list">
                                                <div class="media">
                                                    <div class="media-icon bg-primary-transparent text-primary">
                                                        <i class="icon ion-logo-google"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        {{ $user->name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mg-y-30">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-sm-12 col-xl-12 col-lg-12 col-md-12">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="counter-status d-flex md-mb-0">
                                        <div class="counter-icon bg-primary-transparent">
                                            <i class="icon-layers text-primary"></i>
                                        </div>
                                        <div class="ml-auto">
                                            <h5 class="tx-13">Orders</h5>
                                            <h2 class="mb-0 tx-22 mb-1 mt-1">{{ $orders }}</h2>
                                            @if($orders)
                                                <p class="text-muted mb-0 tx-11"><i
                                                        class="si si-arrow-up-circle text-success mr-1"></i>increase</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="tabs-menu ">
                                    <!-- Tabs -->
                                    <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                                        <li class="active">
                                            <a href="#settings" data-toggle="tab" aria-expanded="false"> <span
                                                    class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span>
                                                <span class="hidden-xs">SETTINGS</span> </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                                    <div class="tab-pane active show" id="settings">
                                        @if(!empty(session('message')))
                                            <div class="alert alert-success">
                                                {{ session('message') ?? '' }}
                                            </div>
                                        @endif
                                        @if(!empty(session('error')))
                                            <div class="alert alert-danger">
                                                {{ session('error') ?? '' }}
                                            </div>
                                        @endif
                                        <form role="form" method="POST" action="{{ route('user.update', $user->id) }}">
                                            @csrf

                                            <div class="form-group">
                                                <label for="FullName">Full Name</label>
                                                <input type="text" name="name" id="name" value="{{ $user->name }}"
                                                       class="form-control @error('name') is-invalid @enderror">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="Email">Email address</label>
                                                <input name="email" type="email" value="{{ $user->email }}" id="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       required>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Phone number</label>
                                                <vue-tel-input :required="true" :valid-characters-only="true"
                                                               :input-options="{ showDialCode: true }"
                                                               value="{{ $user->telephone }}"></vue-tel-input>
                                                @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="Password">Password</label>
                                                <input type="password" name="password" placeholder="6 - 15 Characters"
                                                       id="Password"
                                                       class="form-control @error('password') is-invalid @enderror">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="RePassword">Confirm Password</label>
                                                <input type="password" name="password_confirmation"
                                                       placeholder="6 - 15 Characters" id="password_confirmation"
                                                       class="form-control @error('password_confirmation') is-invalid @enderror">
                                            </div>
                                            <button class="btn btn-primary waves-effect waves-light w-md" type="submit">
                                                Update
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row closed -->
            </div>
        </div>
    </div>
@endsection
