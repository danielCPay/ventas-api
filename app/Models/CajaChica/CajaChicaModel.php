<?php

namespace App\Models\CajaChica;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class CajaChicaModel
{   
	
	public static function Resumen_Caja_Gastos(String $nroliquidacion): array
	{
		$parametros=array($nroliquidacion);
		$res = DB::select("CALL sp_resumen_caja_gastos(?)",$parametros);
		return $res;
		
	}	
	public static function Resumen_Caja_Ingreso(String $codusu): array
	{
		$parametros=array($codusu);
		$res = DB::select("CALL sp_resumen_caja_ingreso(?)",$parametros);
		return $res;
		
	}	
	public static function Resumen_Caja_Tarjetas(String $nroliquidacion): array
	{
		$parametros=array($nroliquidacion);
		$res = DB::select("CALL sp_resumen_caja_tarjetas(?)",$parametros);
		return $res;
		
	}	
	public static function Resumen_Caja_Ventas(String $nroliquidacion): array
	{
		$parametros=array($nroliquidacion);
		$res = DB::select("CALL sp_resumen_caja_ventas(?)",$parametros);
		return $res;
		
	}	
	public static function Resumen_Caja_Productos(String $nroliquidacion): array
	{
		$parametros=array($nroliquidacion);
		$res = DB::select("CALL sp_resumen_caja_productos(?)",$parametros);
		return $res;
		
	}	

	public static function Genera_Numero_CajaChica(): Object
	{	
		$res = DB::select("CALL sp_genera_num_cajachica(@n_numerocajachica)");
		return $res[0] ?? new \stdClass();
	}	

	public static function Listado(Int $page_index, Int $page_size, $fecha_inicio, $fecha_fin,
	$codusu):  ListaPaginacion
	{   
        $parametros = array(
			$page_index,
			$page_size,		
			$fecha_inicio,
			$fecha_fin,	
            $codusu
		);
		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL sp_caja_chica_listar(?, ?, ?, ?, ?)');
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
			array_key_exists('caja_chica_id',$datos)? $datos['caja_chica_id']:NULL,			
			$datos['codusu'],
			$datos['nrcajachica'],
			$datos['monto'],
			$datos['cajaid']											
		);
		$res = DB::select("CALL sp_caja_chica_ins_upd(?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}

	public static function Cierre_Caja(Array $datos): Object
	{		       
		$parametros = array(
			array_key_exists('caja_chica_id',$datos)? $datos['caja_chica_id']:NULL									
		);
		$res = DB::select("CALL sp_caja_chica_cierre(?)",$parametros);
		return $res[0] ?? null;
	}

	public static function Verificar_CajaChica_Usuario(String $codusu): Object
	{
		$parametros = array(
			$codusu			
		);
		$res = DB::select("CALL sp_verificar_cajachica_usuario(?)",$parametros);
		return $res[0] ?? new \stdClass();
	}

	public static function Verificar_CajaChica_Num_Liquidacion(String $nroliquidacion): Object
	{
		$parametros = array(
			$nroliquidacion			
		);
		$res = DB::select("CALL sp_verificar_caja_num_liquidacion(?)",$parametros);
		return $res[0] ?? new \stdClass();
	}
}