<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Prestador extends Model
{
    use HasFactory;

    protected $connection = "xeilon";
    protected $table = "prestadores";

    public static function get_all_prestadores(){
        $result = DB::connection('xeilon')
            ->table('prestadores as prest')
            ->select(
                'prest.IdPrestador',
                'prest.IdLocalidad',
                'prest.IdZona',
                'prest.Nombre',
                'prest.Tipo',
                'prest.CUIT_CUIL',
                'prest.NroPrestador',
                'prest.Activo',
                'prest.ConvenioCamara',
                'prest.ConvenioSaludJujuy',
                'prest.fechaAlta',
                'prest.Direccion',
                'z.Zona',
                'prest.Observacion'
            )
            ->leftJoin('zonas as z','z.IdZona','=','prest.IdZona')
            ->distinct()
            ->get();
        return $result;
    }

    public static function get_prestador($req){
        $result = DB::connection('xeilon')
            ->table('prestadores as prest')
            ->select(
                'prest.IdPrestador',
                'prest.IdLocalidad',
                'prest.IdZona',
                'prest.Nombre',
                'prest.Tipo',
                'prest.CUIT_CUIL',
                'prest.NroPrestador',
                'prest.Activo',
                'prest.ConvenioCamara',
                'prest.ConvenioSaludJujuy',
                'prest.fechaAlta',
                'prest.Direccion',
                'z.Zona',
                'prest.Observacion',
                'mm.Matricula',
                'prov.NombreProvincia',
                'l.NombreLocalidad'
            )
            ->leftJoin('zonas as z','z.IdZona','=','prest.IdZona')
            ->leftJoin('medicomatricula as mm','mm.IdPrestador','=','prest.IdPrestador')
            ->leftJoin('especialidadesprestador as ep','ep.IdPrestador','=','prest.IdPrestador')
            ->leftJoin('especialidades as esp','esp.IdEspecialidad','=','mm.IdEspecialidad')
            ->leftJoin('localidades as l','l.IdLocalidad','=','prest.IdLocalidad')
            ->leftJoin('provincias as prov','prov.IdProvincia','=','l.IdProvincia')
            ->where('prest.IdPrestador', $req)
            ->orWhere('prest.Nombre', 'like', '%' . $req . '%')
            ->orWhere('prest.CUIT_CUIL', 'like', '%' . $req . '%')
            ->orWhere('prest.NroPrestador', 'like', '%' . $req . '%')
            ->distinct()
            ->get();
        return $result;
    }

    public static function get_one_prestador($req){
        $result = DB::connection('xeilon')
            ->table('prestadores as prest')
            ->select(
                'prest.IdPrestador',
                'prest.IdLocalidad',
                'prest.IdZona',
                'prest.Nombre',
                'prest.Tipo',
                'prest.CUIT_CUIL',
                'prest.NroPrestador',
                'prest.Activo',
                'prest.ConvenioCamara',
                'prest.ConvenioSaludJujuy',
                'prest.fechaAlta',
                'prest.Direccion',
                'z.Zona',
                'prest.Observacion',
                'mm.Matricula',
                'prov.NombreProvincia',
                'l.NombreLocalidad'
            )
            ->leftJoin('zonas as z','z.IdZona','=','prest.IdZona')
            ->leftJoin('medicomatricula as mm','mm.IdPrestador','=','prest.IdPrestador')
            ->leftJoin('especialidadesprestador as ep','ep.IdPrestador','=','prest.IdPrestador')
            ->leftJoin('especialidades as esp','esp.IdEspecialidad','=','mm.IdEspecialidad')
            ->leftJoin('localidades as l','l.IdLocalidad','=','prest.IdLocalidad')
            ->leftJoin('provincias as prov','prov.IdProvincia','=','l.IdProvincia')
            ->where('prest.IdPrestador', $req)
            ->distinct()
            ->get();
        return $result;
    }

    public static function get_prestador_with_os($req){
        $result = DB::connection('xeilon')
            ->table('prestadores as prest')
            ->select(
                'lpe.NombreLista'
            )
            ->leftJoin('listasprestadoresdet as lpd','lpd.IdPrestador','=','prest.IdPrestador')
            ->leftJoin('listasprestadoresenc as lpe','lpe.IdListasPrestadores','=','lpd.IdListasPrestadores')
            ->where('prest.IdPrestador',$req)
            ->get(); 
        return $result;
    }


}
