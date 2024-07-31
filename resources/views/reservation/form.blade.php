@extends('layouts.main')

@section('container')

    <!-- content @s -->
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview wide-md mx-auto">

                        <div class="nk-block nk-block-lg">

                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <h4 class="nk-block-title">Reservation Form</h4>
                                            <div class="nk-block-des">
                                                <p>Please fill out this form for reservation</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mx-auto">
                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">

                                <form action="#" id="form-reservation" method="POST" class="form-validate is-alter">

                                    <div class="card-inner">
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="inputDate">Date</label>
                                                    <div class="form-control-wrap">
                                                        <ul class="custom-control-group">

                                                            @foreach($list_date as $row)
                                                                <li>
                                                                    <div class="custom-control custom-radio custom-control-pro no-control">
                                                                        <input type="radio" class="custom-control-input" name="date" id="radio-{{ $row['date'] }}" value="{{ $row['full_date'] }}" required>
                                                                        <label class="custom-control-label" for="radio-{{ $row['date'] }}" value="{{ $row['date'] }}" style="display:block !important;">
                                                                            {{ $row['day'] }}<br>
                                                                            <h3>{{ $row['date'] }}</h3>
                                                                            {{ $row['month'] }}
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-inner border-top">
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="inputTime">Time</label>
                                                    <div class="form-control-wrap">
                                                        <ul class="custom-control-group">

                                                            @foreach($list_time as $row)
                                                                <li>
                                                                    <div class="custom-control custom-radio custom-control-pro no-control">
                                                                        <input type="radio" class="custom-control-input time-class" name="time" id="sex-{{ $row }}" value="{{ $row }}" required>
                                                                        <label class="custom-control-label" for="sex-{{ $row }}" style="display:block !important;">
                                                                            {{ $row }}<br>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-inner border-top">
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">

                                                    <span class="preview-title-lg overline-title">Reservation Form</span>

                                                        <div class="row gy-4">

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="inputChoosePackage">Choose Package</label>
                                                                    <div class="form-control-wrap">
                                                                        <ul class="custom-control-group">    
                                                                            <li>       
                                                                                <div class="custom-control custom-control-md custom-radio custom-control-pro no-control">            
                                                                                    <input type="radio" class="custom-control-input choose-package" name="choosePackage" id="radioPackage" value="package" required>            
                                                                                    <label class="custom-control-label" for="radioPackage"><em class="icon ni ni-check"></em>&nbsp;Package</label>       
                                                                                </div>  
                                                                            </li>   
                                                                            <li>       
                                                                                <div class="custom-control custom-control-md custom-radio custom-control-pro no-control">            
                                                                                    <input type="radio" class="custom-control-input choose-non-package" name="choosePackage" id="radioNonPackage" value="non-package">            
                                                                                    <label class="custom-control-label" for="radioNonPackage"><em class="icon ni ni-cross"></em>&nbsp;Non-Package</label>       
                                                                                </div>  
                                                                            </li>   
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-8">
                                                                <div id="__containCategory" style="display:none;">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="inputCategory">Category</label>
                                                                    <div class="form-control-wrap">
                                                                        <ul class="custom-control-group">    
                                                                            <li>       
                                                                                <div class="custom-control custom-control-md custom-radio custom-control-pro no-control">            
                                                                                    <input type="radio" class="custom-control-input" name="category" id="radioPelajar" value="pelajar" required>            
                                                                                    <label class="custom-control-label" for="radioPelajar">
                                                                                        <em class="icon ni ni-user-alt"></em>&nbsp;
                                                                                        Pelajar
                                                                                    </label>       
                                                                                </div>  
                                                                            </li>   
                                                                            <li>       
                                                                                <div class="custom-control custom-control-md custom-radio custom-control-pro no-control">            
                                                                                    <input type="radio" class="custom-control-input" name="category" id="radioReguler" value="reguler">            
                                                                                    <label class="custom-control-label" for="radioReguler">
                                                                                        <em class="icon ni ni-user-alt-fill"></em>&nbsp;
                                                                                        Reguler
                                                                                    </label>       
                                                                                </div>  
                                                                            </li>   
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>

                                                            <div id="__containPackage" style="display:none;">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="inputPackage" class="form-label">Package</label>
                                                                        <div class="form-control-wrap">
                                                                            <div class="form-icon form-icon-left">
                                                                                <em class="icon ni ni-money"></em>
                                                                            </div>
                                                                            <select name="package" id="id-package" class="form-control"></select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-8">
                                                                <div class="form-group">
                                                                    <label for="inputTable" class="form-label">Table</label>
                                                                    <div class="form-control-wrap">
                                                                        <div class="form-icon form-icon-left">
                                                                            <em class="icon ni ni-money"></em>
                                                                        </div>
                                                                        <select name="table" id="id-table" class="form-control"></select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="inputDuration" class="form-label">Duration</label>
                                                                    <div class="form-control-wrap">
                                                                        <div class="form-icon form-icon-left">
                                                                            <em class="icon ni ni-clock"></em>
                                                                        </div>
                                                                        <input type="number" name="duration" class="form-control" id="id-duration" placeholder="Duration" value="0" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="inputName" class="form-label">Name</label>
                                                                    <div class="form-control-wrap">
                                                                        <div class="form-icon form-icon-left">
                                                                            <em class="icon ni ni-users"></em>
                                                                        </div>
                                                                        <input type="text" name="name" class="form-control" id="id-name" placeholder="Name" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail" class="form-label">Email</label>
                                                                    <div class="form-control-wrap">
                                                                        <div class="form-icon form-icon-left">
                                                                            <em class="icon ni ni-mail"></em>
                                                                        </div>
                                                                        <input type="text" name="email" class="form-control" id="id-email" placeholder="Email" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail" class="form-label">Phone Number</label>
                                                                    <div class="form-control-wrap">
                                                                        <div class="form-icon form-icon-left">
                                                                            <em class="icon ni ni-contact"></em>
                                                                        </div>
                                                                        <input type="int" name="phone_number" class="form-control" id="id-phone-number" placeholder="Phone Number" required>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-inner border-top">
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">

                                                        <div class="row gy-4">

                                                            <div class="col-sm-8"></div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="inputEmail" class="form-label">Total Cost</label>
                                                                    <div class="form-control-wrap">
                                                                        <div class="form-icon form-icon-left">
                                                                            <em class="icon ni ni-money"></em>
                                                                        </div>
                                                                        <input type="text" class="form-control" id="total-cost" placeholder="Total Cost" required disabled>
                                                                        <input type="hidden" name="total_cost" id="id-total-cost">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-sm-12">
                                                                <ul class="d-flex gx-4 mt-1">
                                                                    <li>
                                                                        <button type="reset" class="btn btn-danger btn-dim"><em class="icon ni ni-setting"></em><span>Reset</span></button>
                                                                    </li>
                                                                    <li>
                                                                        <button id="btn-reservation" type="submit" class="btn btn-primary"><em class="icon ni ni-save"></em><span>Check Reservation</span></button>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content @s -->

@endsection