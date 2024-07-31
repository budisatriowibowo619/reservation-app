@extends('layouts.main')

@section('container')

<div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview wide-lg mx-auto">

                        <div class="nk-block nk-block-lg">
                            <div class="row g-gs">
                                <div class="col-xxl-3 col-sm-6">
                                    <div class="card">
                                        <div class="nk-ecwg nk-ecwg6">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Reservations Today</h6>
                                                    </div>
                                                </div>
                                                <div class="data">
                                                    <div class="data-group">
                                                        <div class="amount">{{ $total['total_reservations_hari'] }} </div>
                                                        <div class="nk-ecwg6-ck">
                                                            <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div> --}}
                                                </div>
                                            </div><!-- .card-inner -->
                                        </div><!-- .nk-ecwg -->
                                    </div><!-- .card -->
                                </div><!-- .col -->
                                <div class="col-xxl-3 col-sm-6">
                                    <div class="card">
                                        <div class="nk-ecwg nk-ecwg6">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">Total Reservations</h6>
                                                    </div>
                                                </div>
                                                <div class="data">
                                                    <div class="data-group">
                                                        <div class="amount">{{ $total['total_reservations'] }}</div>
                                                        <div class="nk-ecwg6-ck">
                                                            <canvas class="ecommerce-line-chart-s3" id="todayRevenue"></canvas>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="info"><span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>2.34%</span><span> vs. last week</span></div> --}}
                                                </div>
                                            </div><!-- .card-inner -->
                                        </div><!-- .nk-ecwg -->
                                    </div><!-- .card -->
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .nk-block -->

                    </div>
                </div>
            </div>
        </div>
</div>

@endsection