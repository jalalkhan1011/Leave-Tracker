@extends('admin.layouts.master')

@section('title', 'Dashboard')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Total leave requests') }} </h5>

                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <h6>{{ $totalLeave ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">{{ __('Total pending requests') }} </h5>

                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <h6>{{ $pendingRequest ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-3 col-xl-12">
                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">{{ __('Total approved requests') }} </h5>

                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <h6>{{ $approveRequest ?? 0 }}</h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->
                    <div class="col-xxl-3 col-xl-12">
                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">{{ __('Total  rejected requests') }} </h5>

                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        <h6>{{ $rejectRequest ?? 0 }}</h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
@endsection

