<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Zona extends Model
{
    use HasFactory;
    protected $connection = "xeilon";
    protected $table = "zonas";

    public static function get_all_zonas(){
        $result = DB::connection('xeilon')->table('zonas as z')
        ->select('z.IdZona','z.Zona')
        ->get();
        return $result;
    }

    public static function get_zona($req){
        $result = DB::connection('xeilon')->table('zonas as z')
        ->select('z.IdZona','z.Zona')
        ->where('z.Zona','LIKE', '%' . $req . '%')
        ->get();
        return $result;
    }
}
