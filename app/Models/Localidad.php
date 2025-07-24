<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Localidad extends Model
{
    use HasFactory;

    protected $connection = "xeilon";
    protected $table = "localidades";

    public static function get_all_localidades(){
        $result = DB::connection('xeilon')->table('localidades as loc')
        ->select('loc.IdLocalidad','loc.IdProvincia','loc.NombreLocalidad','loc.CodPostal','loc.Activo')
        ->get();
        return $result;
    }

    public static function get_localidad($req){
        $result = DB::connection('xeilon')->table('localidades as loc')
        ->select('loc.IdLocalidad','loc.IdProvincia','loc.NombreLocalidad','loc.CodPostal','loc.Activo')
        ->where('loc.NombreLocalidad',$req)
        ->get();
        return $result;
    }
}
