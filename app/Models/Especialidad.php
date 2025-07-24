<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Especialidad extends Model
{
    use HasFactory;

    protected $connection = "xeilon";
    protected $table = "especialidades";

    public static function get_all_especialidades(){
        $result = DB::connection('xeilon')->table('especialidades as esp')
        ->select('esp.IdEspecialidad','esp.Especialidad','esp.Activo')
        ->get();
        return $result;
    }

    public static function get_especialidad($req){
        $result = DB::connection('xeilon')->table('especialidades as esp')
        ->select('esp.IdEspecialidad','esp.Especialidad','esp.Activo')
        ->where('esp.Especialidad', 'LIKE', '%' . $req . '%')
        ->get();
        return $result;
    }
}