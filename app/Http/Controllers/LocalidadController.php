<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localidad;

class LocalidadController extends Controller
{
    public function list_localidades(){
        $localidades = Localidad::get_all_localidades();
        return response()->json($localidades);
    }

    public function search_localidad($req){
        $localidad = Localidad::get_localidad($req);
        return response()->json($localidad);
    }
}
