<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Table extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function select2_table($params = [])
    {
        $start = isset($params['start']) ? $params['start'] : 0;
        $limit = isset($params['limit']) ? $params['limit'] : 20;
        $search = isset($params['search']) ? $params['search'] : '';

        $condition = '';

        $query = static::select('id', DB::raw('CONCAT(description) as text'))
                        ->where('status','=',1)
                        ->where(function ($query) use ($search) {
                            $query->where('description','like','%'.$search.'%');
                        })
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
