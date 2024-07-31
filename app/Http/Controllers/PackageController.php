<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page_master_package()
    {
        return view('master/package', [
            'page'      => 'Package Master',
            'js_script' => 'js/master/package.js'
        ]);
    }

    public static function ajax_dt_master_package(Request $request)
    {
        if ($request->ajax()) {
            $gt_master = Package::where('status','!=',0)->get();

            $DT_master = Datatables::of($gt_master)
                                    ->addIndexColumn()
                                    ->addColumn('action', function($row){
                                        $button  =  '<a href="#" onClick="editMasterPackage('.$row->id.')" class="btn btn-icon btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><em class="icon ni ni-pen2"></em></a>';
                                        $button .= ' <a href="#" onClick="deleteMasterPackage('.$row->id.')" class="btn btn-icon btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><em class="icon ni ni-trash"></em></a>';
                                        return $button;
                                    })->rawColumns(['action'])->make(true);

            return $DT_master;
        }
    }

    public static function ajax_gt_master_package(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'id'   => 'required'
            ]);

            if($validator->fails()) return response()->json(implode(',',$validator->errors()->all()), 422);
            
            
            $gt_master_package = Package::firstWhere('id', $request->id);

            return response()->json($gt_master_package);
        }
    }

    public static function ajax_pcs_master_package(Request $request)
    {
        if($request->ajax()) {

            $validator = Validator::make($request->all(), [
                // 'category'      => 'required',
                'description'   => 'required',
                'price'         => 'required',
                'time'          => 'required',
                'duration'      => 'required'
            ]);

            if($validator->fails()) return response()->json(implode(',',$validator->errors()->all()), 422);

            Package::updateOrCreate(
                ['id'   => $request->id],
                [
                    'category'      => $request->category,
                    'description'   => $request->description,
                    'price'         => $request->price,
                    'time'          => $request->time,
                    'duration'      => $request->duration,
                    'status'        => 1
                ]
            );

            return response()->json(['success' => TRUE, 'message'  => 'Package data has been save']);
        }
    }

    public function ajax_del_master_package(Request $request)
    {
        if($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'id'   => 'required'
            ]);

            if($validator->fails()) return response()->json(implode(',',$validator->errors()->all()), 422);

            Package::where('id', $request->id)->update(['status' => 0]);

            return response()->json([
                'success'   => TRUE,
                'message'   => 'Package master delete successfully'
            ]);
        }
    }

    public function ajax_select_package(Request $request)
    {
        if($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'page'      => 'required',
                'time'      => 'required'
            ]);

            if($validator->fails()) return response()->json(implode(',',$validator->errors()->all()), 422);

            $start = $request->page;
            $limit = 20;

            if($start <= 0){
                $start = 1;
            }

            $select_master_package = Package::select2_package([
                'start'     => ceil($start - 1) * 20,
                'limit'     => $limit,
                'search'    => $request->search,
                'time'      => $request->time,
                // 'category'  => $request->category
            ]);

            $response = [
                'results'    => $select_master_package['query'],
                'pagination' => [
                    'more'  => ($start * 20) < $select_master_package['count']
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
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        //
    }
}
