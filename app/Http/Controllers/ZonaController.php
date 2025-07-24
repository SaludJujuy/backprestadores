<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zona;
class ZonaController extends Controller
{
    public function list_zonas(){
        $zonas = Zona::get_all_zonas();
        return response()->json($zonas);
    }

    public function search_zona($req){
        $zona = Zona::get_zona($req);
        return response()->json($zona);
    }
}
