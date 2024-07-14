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
                                            <h4 class="nk-block-title">Master Package</h4>
                                            <div class="nk-block-des">
                                                <p>Billiard package master</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mx-auto">
                                            <a href="#" onClick="showMasterPackage()" class="btn btn-outline-primary float-end"><em class="icon ni ni-plus"></em><span>Add Data</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="table display nowrap" id="tablePackage" style="width:100%;">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Time</th>
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

    <!-- Modal Add Event -->
    <div class="modal fade" id="modalMasterPackage">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Package</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="#" id="formPackage" method="POST" class="form-validate is-alter">
                        <input type="hidden" id="idPackage" name="id" value="">
                        <div class="row gx-4 gy-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="inputCategory">Category</label>
                                        <div class="form-control-wrap">
                                            <ul class="custom-control-group">    
                                                <li>       
                                                    <div class="custom-control custom-control-sm custom-radio custom-control-pro">            
                                                        <input type="radio" class="custom-control-input" name="category" id="radioPelajar" value="pelajar" required>            
                                                        <label class="custom-control-label" for="radioPelajar">Pelajar</label>       
                                                    </div>  
                                                </li>   
                                                <li>       
                                                    <div class="custom-control custom-control-sm custom-radio custom-control-pro">            
                                                        <input type="radio" class="custom-control-input" name="category" id="radioReguler" value="reguler">            
                                                        <label class="custom-control-label" for="radioReguler">Reguler</label>       
                                                    </div>  
                                                </li>   
                                            </ul>
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="inputDuration">Duration <small>(per hour)</small></label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-clock"></em>
                                        </div>
                                        <input type="number" class="form-control" minlength="1" maxlength="1" name="duration" min="1" max="3" id="inputDuration" placeholder="Duration" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="inputPrice">Price</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-money"></em>
                                        </div>
                                        <input type="number" class="form-control" name="price" id="inputPrice" placeholder="Price" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="inputTime">Time</label>
                                    <ul class="custom-control-group g-2 align-center flex-wrap mt-0">
                                        <li>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="radioSiang" name="time" value="siang">
                                                <label for="radioSiang" class="custom-control-label">Siang</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="radioMalam" name="time" value="malam">
                                                <label for="radioMalam" class="custom-control-label">Malam</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label" for="inputDescription">Description</label>
                                    <div class="form-control-wrap">
                                        <textarea name="description" id="inputDescription" class="form-control" placeholder="Description" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12"><hr></div>
                            <div class="col-12">
                                <ul class="d-flex justify-content-between gx-4 mt-1">
                                    <li>
                                        <button type="submit" class="btn btn-primary"><em class="icon ni ni-save"></em><span>Save</span></button>
                                    </li>
                                    <li>
                                        <button type="button" onClick="hideMasterPackage()" class="btn btn-danger btn-dim">Discard</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Add Event -->


@endsection