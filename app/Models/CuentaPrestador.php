<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;

class CuentaPrestador extends Model
{
    use HasFactory;

    protected $connection = "xeilon";

    public static function get_all_ctacte_prestador($req){
        // 1. Convertir el periodo a fecha y generar los 12 meses anteriores
        $fecha = DateTime::createFromFormat('m-Y', str_replace('/', '-', now()->format('m-Y')));
        if (!$fecha) return [];

        $periodos = [];
        for ($i = 0; $i < 12; $i++) {
            $periodos[] = $fecha->format('m/Y');
            $fecha->modify('-1 month');
        }

        $result = [];
        for($i = 0; $i < count($periodos); $i++){
            $data = DB::connection('xeilon')
                ->table('prestadores as prest')
                ->select(
                    DB::raw('MAX(ctacte.Periodo) as Periodo'),
                    DB::raw('SUM(ctacte.ImporteHonorarios) as honorarios'),
                    DB::raw('SUM(ctacte.IvaHonorarios) as ivahonorarios'),
                    DB::raw('SUM(ctacte.ImporteGastos) as gastos'),
                    DB::raw('SUM(ctacte.IvaGastos) as ivagastos'),
                    DB::raw('SUM(ctacte.ImporteMedicamentos) as medicamentos'),
                    DB::raw('SUM(ctacte.IvaMedicamentos) as ivamedicamentos'),
                    DB::raw('SUM(ctacte.ImporteTotal) as total')
                )
                ->leftJoin('ctacteprestadores as ctacte', 'ctacte.IdPrestador', '=', 'prest.IdPrestador')
                ->where('prest.IdPrestador', $req)
                ->where('ctacte.Periodo',$periodos[$i])
                ->orderBy('ctacte.Periodo', 'desc')
                ->get()
                ->keyBy('Periodo'); // Para acceso rápido por clave;
        
            // 3. Armar resultado final con ceros donde no haya datos
            $result[] = [
                'Periodo' => $periodos[$i],
                'honorarios' => $data[$periodos[$i]]->honorarios ?? 0,
                'ivahonorarios' => $data[$periodos[$i]]->ivahonorarios ?? 0,
                'gastos' => $data[$periodos[$i]]->gastos ?? 0,
                'ivagastos' => $data[$periodos[$i]]->ivagastos ?? 0,
                'medicamentos' => $data[$periodos[$i]]->medicamentos ?? 0,
                'ivamedicamentos' => $data[$periodos[$i]]->ivamedicamentos ?? 0,
                'total' => $data[$periodos[$i]]->total ?? 0,
            ];   
        }
        return $result;
    }

    public static function get_ctacte_prestador($req,$periodo){
        // 1. Convertir el periodo a fecha y generar los 12 meses anteriores
        $fecha = \DateTime::createFromFormat('m-Y', str_replace('/', '-', $periodo));
        if (!$fecha) return [];

        $periodos = [];
        for ($i = 0; $i < 12; $i++) {
            $periodos[] = $fecha->format('m/Y');
            $fecha->modify('-1 month');
        }

        // 2. Consultar la base de datos con los períodos deseados
        $data = DB::connection('xeilon')
            ->table('prestadores as prest')
            ->leftJoin('ctacteprestadores as ctacte', 'ctacte.IdPrestador', '=', 'prest.IdPrestador')
            ->select(
                DB::raw('ctacte.Periodo as Periodo'),
                DB::raw('SUM(ctacte.ImporteHonorarios) as honorarios'),
                DB::raw('SUM(ctacte.IvaHonorarios) as ivahonorarios'),
                DB::raw('SUM(ctacte.ImporteGastos) as gastos'),
                DB::raw('SUM(ctacte.IvaGastos) as ivagastos'),
                DB::raw('SUM(ctacte.ImporteMedicamentos) as medicamentos'),
                DB::raw('SUM(ctacte.IvaMedicamentos) as ivamedicamentos'),
                DB::raw('SUM(ctacte.ImporteTotal) as total')
            )
            ->where('prest.IdPrestador', $req)
            ->whereIn('ctacte.Periodo', $periodos)
            ->groupBy('ctacte.Periodo')
            ->get()
            ->keyBy('Periodo'); // Para acceso rápido por clave

        // 3. Armar resultado final con ceros donde no haya datos
        $result = [];
        foreach ($periodos as $p) {
            $result[] = [
                'Periodo' => $p,
                'honorarios' => $data[$p]->honorarios ?? 0,
                'ivahonorarios' => $data[$p]->ivahonorarios ?? 0,
                'gastos' => $data[$p]->gastos ?? 0,
                'ivagastos' => $data[$p]->ivagastos ?? 0,
                'medicamentos' => $data[$p]->medicamentos ?? 0,
                'ivamedicamentos' => $data[$p]->ivamedicamentos ?? 0,
                'total' => $data[$p]->total ?? 0,
            ];
        }

        return $result;
    }
}

