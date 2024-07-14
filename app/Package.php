<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function select2_package($params = [])
    {
        $start = isset($params['start']) ? $params['start'] : 0;
        $limit = isset($params['limit']) ? $params['limit'] : 20;
        $search = isset($params['search']) ? $params['search'] : '';
        $time = isset($params['time']) ? $params['time'] : '';
        $category = isset($params['category']) ? $params['category'] : '';

        $condition = '';

        $condition_time = '';
        if($time >= '17:00'){
            $condition_time = 'malam';
        } else {
            $condition_time = 'siang';
        }

        $query = static::select('id', DB::raw('CONCAT("Paket ",category," - ",description," - ",duration," Jam") as text'))
                        ->where('status','=',1)
                        ->where(function ($query) use ($search) {
                            $query->where('description','like','%'.$search.'%');
                        })
                        ->where(function ($query) use ($condition_time) {
                            if(!empty($condition_time)) $query->where('time','=',$condition_time);
                        })
                        ->where(function ($query) use ($category) {
                            if(!empty($category)) $query->where('category','=',$category);
                        })
                        // ->whereNotExists(function ($query) use ($tanggal) {
                        //     $query->select('peminjaman_kendaraan.id')
                        //             ->from('peminjaman_kendaraan')
                        //             ->where('peminjaman_kendaraan.status', '=', '1')
                        //             ->whereRaw('peminjaman_kendaraan.id_kendaraan = kendaraan.id')
                        //             ->where('peminjaman_kendaraan.tanggal', '=', $tanggal);
                        // })
                        ->orderBy('description', 'ASC')
                        ->offset($start)
                        ->limit($limit);
        
        $response = [
            'query' => $query->get(),
            'count' => $query->count()
        ];

        return $response;
    }
}
