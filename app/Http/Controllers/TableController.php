<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page_master_table()
    {
        return view('master/table', [
            'page'      => 'Table Master',
            'js_script' => 'js/master/table.js'
        ]);
    }

    public static function ajax_dt_master_table(Request $request)
    {
        if ($request->ajax()) {
            $gt_master = Table::where('status','!=',0)->get();

            $DT_master = Datatables::of($gt_master)
                                    ->addIndexColumn()
                                    ->addColumn('action', function($row){
                                        $button  =  '<a href="#" onClick="editMasterTable('.$row->id.')" class="btn btn-icon btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><em class="icon ni ni-pen2"></em></a>';
                                        $button .= ' <a href="#" onClick="deleteMasterTable('.$row->id.')" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><em class="icon ni ni-trash"></em></a>';
                                        return $button;
                                    })->rawColumns(['action'])->make(true);

            return $DT_master;
        }
    }

    public static function ajax_gt_master_table(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'id'   => 'required'
            ]);

            if($validator->fails()) return response()->json(implode(',',$validator->errors()->all()), 422);
            
            
            $gt_master_table = Table::firstWhere('id', $request->id);

            return response()->json($gt_master_table);
        }
    }

    public static function ajax_pcs_master_table(Request $request)
    {
        if($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'description'   => 'required',
            ]);

            if($validator->fails()) return response()->json(implode(',',$validator->errors()->all()), 422);

            Table::updateOrCreate(
                ['id'   => $request->id],
                [
                    'description'   => $request->description,
                    'status'        => 1
                ]
            );

            return response()->json(['success' => TRUE, 'message'  => 'Table data has been save']);
        }
    }

    public function ajax_del_master_table(Request $request)
    {
        if($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'id'   => 'required'
            ]);

            if($validator->fails()) return response()->json(implode(',',$validator->errors()->all()), 422);

            Table::where('id', $request->id)->update(['status' => 0]);

            return response()->json([
                'success'   => TRUE,
                'message'   => 'Table master delete successfully'
            ]);
        }
    }

    public function ajax_select_table(Request $request)
    {
        if($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'page'      => 'required'
            ]);

            if($validator->fails()) return response()->json(implode(',',$validator->errors()->all()), 422);

            $start = $request->page;
            $limit = 20;

            if($start <= 0){
                $start = 1;
            }

            $select_master_table = Table::select2_table([
                'start'     => ceil($start - 1) * 20,
                'limit'     => $limit,
                'search'    => $request->search
            ]);

            $response = [
                'results'    => $select_master_table['query'],
                'pagination' => [
                    'more'  => ($start * 20) < $select_master_table['count']
                ]
            ];

            return response()->json($response);
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
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        //
    }
}
