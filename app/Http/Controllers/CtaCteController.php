<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestador;
use App\Models\CuentaPrestador;

class CtaCteController extends Controller
{
    public function list_ctacte_prestador($req){
        $ctacte = CuentaPrestador::get_all_ctacte_prestador($req);
        return response()->json($ctacte);
    }

    public function search_ctacte_prestador($req, $periodo){
        $ctacte = CuentaPrestador::get_ctacte_prestador($req, $periodo);
        return response()->json($ctacte);
    }

    public function export_ctacte_prestador($req){
        $fileName = "ctacte_prestador.csv";
        $prestador = Prestador::get_one_prestador($req);
        //dd($prestador[0]->Nombre);
        $ctacte = CuentaPrestador::get_all_ctacte_prestador($req);
        //abrir archivo para escritura
        $handle = fopen($fileName, 'w');
        fwrite($handle, "\xEF\xBB\xBF"); // BOM para Excel
        //cabecera de datos del prestador
        fputcsv($handle, ['Nombre', 'CUIT_CUIL', 'NroPrestador'],';');
        fputcsv($handle,[
            $prestador[0]->Nombre,
            $prestador[0]->CUIT_CUIL,
            $prestador[0]->NroPrestador
        ], ';');

        //linea vacia para separar los datos del prestador de los de la cuenta corriente
        fputcsv($handle,[
            'Periodo',
            'Honorarios',
            'IVA Honorarios',
            'Gastos',
            'IVA Gastos',
            'Medicamentos',
            'IVA Medicamentos',
            'Total',    
        ], ';');

        //datos para la cuenta corriente
    
        for($i = 0; $i < count($ctacte); $i++){
            //dd($ctacte[$i]['Periodo']);
            fputcsv($handle, [
                $ctacte[$i]['Periodo'],
                $ctacte[$i]['honorarios'],
                $ctacte[$i]['ivahonorarios'],
                $ctacte[$i]['gastos'],
                $ctacte[$i]['ivagastos'],
                $ctacte[$i]['medicamentos'],
                $ctacte[$i]['ivamedicamentos'],
                $ctacte[$i]['total']
            ], ';'); //linea vacia
        }
/*
        foreach($ctacte as $row){
            //dd($ctacte, $handle, $row);
            fputcsv($handle,[
                $row->Periodo,
                $row->honorarios,
                $row->ivahonorarios,
                $row->gastos,
                $row->ivagastos,
                $row->medicamentos,
                $row->ivamedicamentos,
                $row->total
            ],';');
        }
*/
        //linea vacias para separar
        fclose($handle);
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}