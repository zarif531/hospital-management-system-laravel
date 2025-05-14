@extends('layouts.master2')

@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('backend/assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
@endsection

@section('title')
    {{ __('auth.register.') }}
@endsection

@section('content')
    <!-- Page -->
    <div class="page">
        <div class="container-fluid">
            <div class="row no-gutter">
                <!-- The image half -->
                <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                    <div class="row wd-100p mx-auto text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                            <img src="{{ URL::asset('backend/assets/img/media/register.jpg') }}"
                                class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                        </div>
                    </div>
                </div>

                <!-- The content half -->
                <div class="col-md-6 col-lg-6 col-xl-5">
                    <div class="login d-flex align-items-center py-2">
                        <!-- Demo content-->
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                    <div class="card-sigin">
                                        <div class="mb-5 d-flex">
                                            <a href="{{ route('web.index') }}">
                                                <img src="{{ URL::asset('frontend/images/HMS.png') }}" alt="logo"
                                                    class="log-favicon ht-40">
                                            </a>
                                            <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">H<span>M</span>S</h1>
                                        </div>

                                        <div class="main-signup-header">
                                            <h2 class="text-primary">
                                                {{ __('general.words.get_started') }}
                                            </h2>
                                            <h5 class="font-weight-normal mb-4">
                                                {{ __('general.note.register') }}
                                            </h5>
                                            <h5 class="font-weight-normal mb-4">
                                                {{ __('auth.register.as') }} {{ __('users.patient') }}
                                            </h5>

                                            @include('users.patient.partials.register-form')

                                            <div class="main-signup-footer mt-5">
                                                <p>
                                                    {{ __('general.warning.register') }}
                                                    <a href="{{ route('login') }}">
                                                        {{ __('auth.login.') }}
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End -->
                    </div>
                </div><!-- End -->
            </div>
        </div>
    </div>
    <!-- End Page -->
@endsection
