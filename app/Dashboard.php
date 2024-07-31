<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dashboard extends Model
{
    use HasFactory;

    public static function query_total_reservation() 
    {
        $total_peminjaman_reservations = DB::table('reservations');
        

        return [
            'total_reservations'        => $total_peminjaman_reservations->where(['status' => 1])->count(),
            'total_reservations_hari'   => $total_peminjaman_reservations->where(['status' => 1])->whereDate('date', date('Y-m-d'))->count(),
        ];
    }
}
