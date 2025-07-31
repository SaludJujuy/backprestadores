<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestador;

class PrestadorController extends Controller
{
    public function list_prestadores(){
        $prestadores = Prestador::get_all_prestadores();
        return response()->json($prestadores);
    }

    public function search_prestador($req){
        $prestador = Prestador::get_prestador($req);
        return response()->json($prestador);
    }

    public function search_one_prestador($req){
        $prestador = Prestador::get_one_prestador($req);
        return response()->json($prestador);
    }

    public function search_prestador_with_afiliados($req){
        $prestador = Prestador::get_prestador_with_afiliados($req);
        return response()->json($prestador);
    }

    public function search_prestador_by_enc($req){
        $prestador = Prestador::get_prestador_by_enc($req);
        return response()->json($prestador);
    }

    public function search_prestador_by_os($req){
        $prestador = Prestador::get_prestador_with_os($req);
        return response()->json($prestador->toArray());
    }

    public function export_all_prestador(){
        $fileName = "presatadores.csv";
        
        $prestadores = Prestador::get_all_prestadores();

        $handle = fopen($fileName, 'w');
        fwrite($handle, "\xEF\xBB\xBF"); // BOM para Excel

        $handle = fopen($fileName, 'w');
        // Usamos punto y coma como separador
        fputcsv($handle, ['IdPrestador', 'IdLocalidad', 'IdZona', 'Nombre', 'Tipo', 'CUIT_CUIL', 'NroPrestador',
            'Activo', 'ConvenioCamara', 'ConvenioSaludJujuy',
            'fechaAlta', 'Direccion', 'Zona', 'Observacion'], ';');

        foreach ($prestadores as $prestador) {
                fputcsv($handle, [
                $prestador->IdPrestador,
                $prestador->IdLocalidad,
                $prestador->IdZona,
                $prestador->Nombre,
                $prestador->Tipo,
                $prestador->CUIT_CUIL,
                $prestador->NroPrestador,
                $prestador->Activo,
                $prestador->ConvenioCamara,
                $prestador->ConvenioSaludJujuy,
                $prestador->fechaAlta,
                $prestador->Direccion,
                $prestador->Zona,
                $prestador->Observacion
            ], ';');
        }

        fclose($handle);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }

    public function export_prestador_by_param($req){
        $fileName = "presatadores.csv";
        $filtros = $req;
        $prestadores = Prestador::get_prestador($filtros);
        $handle = fopen($fileName, 'w');
        fwrite($handle, "\xEF\xBB\xBF"); // BOM para Excel

        $handle = fopen($fileName, 'w');
        // Usamos punto y coma como separador
        fputcsv($handle, ['IdPrestador', 'IdLocalidad', 'IdZona', 'Nombre', 'Tipo', 'CUIT_CUIL', 'NroPrestador',
            'Activo', 'ConvenioCamara', 'ConvenioSaludJujuy',
            'fechaAlta', 'Direccion', 'Zona', 'Observacion'], ';');

        foreach ($prestadores as $prestador) {
                fputcsv($handle, [
                $prestador->IdPrestador,
                $prestador->IdLocalidad,
                $prestador->IdZona,
                $prestador->Nombre,
                $prestador->Tipo,
                $prestador->CUIT_CUIL,
                $prestador->NroPrestador,
                $prestador->Activo,
                $prestador->ConvenioCamara,
                $prestador->ConvenioSaludJujuy,
                $prestador->fechaAlta,
                $prestador->Direccion,
                $prestador->Zona,
                $prestador->Observacion
            ], ';');
        }

        fclose($handle);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }

    public function export_afiliados_by_prestador($req){
        $fileName = "afiliados_prestador.csv";
        $prestador = Prestador::get_one_prestador($req);
        $afiliados = Prestador::get_prestador_with_afiliados($req);
        //abrir archivo para escritura
        $handle = fopen($fileName, 'w');
        fwrite($handle, "\xEF\xBB\xBF"); // BOM para Excel

        //cabecera de datos del prestador
        fputcsv($handle, ['Nombre', 'CUIT_CUIL', 'NroPrestador'], ';');
        fputcsv($handle, [
            $prestador[0]->Nombre,
            $prestador[0]->CUIT_CUIL,
            $prestador[0]->NroPrestador
        ], ';');

        //cabecera de datos de los afiliados
        fputcsv($handle, ['Numero', 'IdAfiliado', 'NroAfiliado', 'NombreAfiliado','NombrePlan', 'FechaEmision'], ';');

        foreach ($afiliados as $afiliado) {
            fputcsv($handle, [
                $afiliado->Numero,
                $afiliado->IdAfiliado,
                $afiliado->NroAfiliado,
                $afiliado->NombreAfiliado,
                $afiliado->NombrePlan,
                $afiliado->FechaEmision
            ], ';');
        }

        fclose($handle);
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
