<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class ClienteModel
{
    public static function Listado(Int $page_index, Int $page_size, 
	$razonsocial):  ListaPaginacion
	{   
        $parametros = array(
			$page_index,
			$page_size,			
            $razonsocial
		);
		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL sp_cli_listar(?, ?, ?)');
		$stmt->execute($parametros);
		$listarRegistros = $stmt->fetchAll($dbh::FETCH_CLASS);
		$stmt->nextRowset();
		$total_registros = $stmt->fetchAll($dbh::FETCH_CLASS);
		$stmt->closeCursor();
		unset($stmt);
		unset($dbh);
		$totalRegistros = $total_registros[0]->total_registros;
		return new ListaPaginacion($listarRegistros, $totalRegistros, $page_size, $page_index);		      
	}

	public static function Insertar_Actualizar(Array $datos): Object
	{		       
		$parametros = array(
			array_key_exists('clienteid',$datos)? $datos['clienteid']:NULL,			
			$datos['tipodocumento'],
			$datos['nrdocumento'],
			$datos['razonsocial'],
			$datos['direccion'],
            $datos['telefono']						
		);
		$res = DB::select("CALL sp_cli_ins_upd(?,?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}

	public static function ClienteGetNroDocumento(String $nrdocumento): Object
	{
		$parametros = array(
			$nrdocumento			
		);
		$res = DB::select("CALL sp_cli_getnrodocumento(?)",$parametros);
		return $res[0] ?? new \stdClass();
	}

	public static function Cliente_Desplegable($tipodocumento): array
	{
		$parametros = array(
			$tipodocumento			
		);
		$res = DB::select("CALL sp_cli_desplegable(?)",$parametros);
		return $res;
	}

	public static function Anular(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['clienteid'],
			$datos['user']										
		);
		$res = DB::select("CALL sp_cliente_anular(?,?)",$parametros);
		return $res[0] ?? null;
	}

}