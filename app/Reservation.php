<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function check_reservation_availability($params = [])
    {
        $table = isset($params['table']) ? $params['table'] : 0;
        // $package = isset($params['package']) ? $params['package'] : 0;
        $date = isset($params['date']) ? $params['date'] : '';
        $time = isset($params['time']) ? $params['time'] : '';
        $duration = isset($params['duration']) ? $params['duration'] : 0;

        $condition = '';

        // $gt_packages = DB::table('packages')->where(['id' => $package])->first();

        $start_time = $time;
        $end_time = date('H:i', (strtotime($time) + 60*60*$duration));

        $query = static::select('id')
                        ->where('status','=',1)
                        ->where(function ($query) use ($table) {
                            if(!empty($table)) $query->where('id_table','=',$table);
                        })
                        // ->where(function ($query) use ($package) {
                        //     if(!empty($package)) $query->where('id_package','=',$package);
                        // })
                        ->where(function ($query) use ($date) {
                            if(!empty($date)) $query->where('date','=',$date);
                        })
                        // ->whereBetween('time', [$start_time, $end_time])
                        // ->orWhereBetween('esnd_time', [$start_time, $end_time])
                        // ->whereRaw('( 
                        //         (time BETWEEN "' . $start_time . '" AND "' . $end_time . '") or
                        //         (end_time BETWEEN "' . $start_time . '" AND "' . $end_time . '")
                        //     )
                        // ')
                        ->whereRaw(
                            '( 
                                ("' . $start_time . '" BETWEEN  time AND end_time) or
                                ("' . $end_time . '" BETWEEN time AND end_time)
                            )
                        '
                        )
                        ;
        
        $response = $query->first();

        return $response;
    }

    public static function get_duration_package($id_packages){

        $gt_packages = DB::table('packages')->where(['id' => $id_packages])->first();

        return $gt_packages->duration;
    }

    public static function gt_reservation_list()
    {
        $query = static::select('reservations.*', DB::raw('CONCAT(IFNULL(packages.description,"Non-Package")) as package'),DB::raw('CONCAT(tables.description) as tablename'),DB::raw('CONCAT(reservations.date," Jam ",reservations.time," s/d ",reservations.end_time) as date_time'))
                        ->leftJoin('packages','packages.id', '=', 'reservations.id_package')
                        ->Join('tables','tables.id', '=', 'reservations.id_table')
                        // ->where('reservations.status','=',1)
                        ->get();

        return $query;
    }

}
