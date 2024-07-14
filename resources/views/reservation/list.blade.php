@extends('layouts.main')

@section('container')

    <!-- content @s -->
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview wide-lg mx-auto">

                        <div class="nk-block nk-block-lg">

                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <h4 class="nk-block-title">Lists of Reservation</h4>
                                            <div class="nk-block-des">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="table display nowrap" id="tableListReservation" style="width:100%;">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Package</th>
                                                <th>Table</th>
                                                <th>Date Time</th>
                                                <th>#</th>
                                            </tr>
                                            <tbody></tbody>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content @s -->

@endsection