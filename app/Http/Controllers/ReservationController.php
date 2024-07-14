<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page_master_reservation_form()
    {
        $dt_date = [];

        $now = date('Y-m-d');
        $_6daysafter = date('Y-m-d', strtotime('+7 days', strtotime(date('Y-m-d'))));

        for ($i = $now; $i <= $_6daysafter; $i++){
            $date = date('d', strtotime($i));
            $day = date('l', strtotime($i));
            $month = date('F', strtotime($i));

            $dt_date[] = [
                'date'  => $date,
                'day'   => $day,
                'month' => $month,
                'full_date' => $i
            ];        
        }

        $dt_time = [
            '13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00','00:00','01:00'
        ];

        return view('reservation/form', [
            'page'      => 'Reservation Form',
            'js_script' => 'js/reservation/form.js',
            'list_date' => $dt_date,
            'list_time' => $dt_time
        ]);
    }

    public function ajax_pcs_reservation_form(Request $request)
    {
        if($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'date'          => 'required',
                'time'          => 'required',
                'category'      => 'required',
                'table'         => 'required',
                'package'       => 'required',
                'name'          => 'required',
                'email'         => 'required',
                'phone_number'  => 'required'
            ]);

            if($validator->fails()) return response()->json(implode(',',$validator->errors()->all()), 422);

            $check_availability = Reservation::check_reservation_availability([
                'table'     => $request->table,
                'package'   => $request->package,
                'date'      => $request->date,
                'time'      => $request->time
            ]);

            if(!empty($check_availability)){

                // return response()->json([
                //     'status'    => FALSE,
                //     'message'   => 'This table has been already booked, please choose a different time'
                // ]);
                return response()->json(false);

            } else {

                $get_duration = Reservation::get_duration_package($request->package);

                Reservation::create(
                [
                    'date'          => $request->date,
                    'time'          => $request->time,
                    'id_table'      => $request->table,
                    'id_package'    => $request->package,
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'phone_number'  => $request->phone_number,
                    'end_time'      => date('H:i:s', (strtotime($request->time) + 60*60*$get_duration)),
                    'duration'      => 0
                ]);

                // return response()->json([
                //     'success'   => TRUE,
                //     'message'   => 'Reservation succesfully booked'
                // ]);

                return response()->json(true);

            }

        }
    }

    public function page_reservation_list()
    {
        return view('reservation/list', [
            'page'      => 'Reservation List',
            'js_script' => 'js/reservation/list.js'
        ]);
    }

    public static function ajax_dt_reservation_list(Request $request)
    {
        if ($request->ajax()) {
            $gt_list_reservation = Reservation::gt_reservation_list();

            $DT_list_reservation = Datatables::of($gt_list_reservation)
                                    ->addIndexColumn()
                                    ->addColumn('action', function($row){
                                        $button = ' <a href="#" onClick="cancelReservation('.$row->id.')" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><em class="icon ni ni-trash"></em></a>';
                                        return $button;
                                    })->rawColumns(['action'])->make(true);

            return $DT_list_reservation;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
