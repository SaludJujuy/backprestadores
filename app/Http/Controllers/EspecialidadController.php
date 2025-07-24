<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidad;

class EspecialidadController extends Controller
{
    public function list_especialidades(){
        $especialidades = Especialidad::get_all_especialidades();
        return response()->json($especialidades);
    }

    public function search_especialidad($req){
        $especialidad = Especialidad::get_especialidad($req);
        return response()->json($especialidad);
    }
}
