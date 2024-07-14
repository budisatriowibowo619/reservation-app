<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\TableController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ReservationController::class, 'index']);

# Page#


# End Page #

# Reservation #

    Route::get('/formReservation', [ReservationController::class, 'page_master_reservation_form']);
    Route::post('/processReservation', [ReservationController::class, 'ajax_pcs_reservation_form']);

    Route::get('/listReservation', [ReservationController::class, 'page_reservation_list']);
    Route::get('/DTReservationList', [ReservationController::class, 'ajax_dt_reservation_list']);

# End Reservation #

# Master #

    # Package
    Route::get('/masterPackage', [PackageController::class, 'page_master_package']);

    Route::get('/DTMasterPackage', [PackageController::class, 'ajax_dt_master_package']);
    Route::get('/gtMasterPackage', [PackageController::class, 'ajax_gt_master_package']);
    Route::post('/processMasterPackage', [PackageController::class, 'ajax_pcs_master_package']);
    Route::get('/deleteMasterPackage', [PackageController::class, 'ajax_del_master_package']);

    Route::get('/selectPackage', [PackageController::class, 'ajax_select_package']);
    # End Package

    # Table
    Route::get('/masterTable', [TableController::class, 'page_master_table']);

    Route::get('/DTMasterTable', [TableController::class, 'ajax_dt_master_table']);
    Route::get('/gtMasterTable', [TableController::class, 'ajax_gt_master_table']);
    Route::post('/processMasterTable', [TableController::class, 'ajax_pcs_master_table']);
    Route::get('/deleteMasterTable', [TableController::class, 'ajax_del_master_table']);

    Route::get('/selectTable', [TableController::class, 'ajax_select_table']);
    # End Table

# End Master #