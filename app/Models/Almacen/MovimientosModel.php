<?php

namespace App\Models\Almacen;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class MovimientosModel
{
   	
	public static function Listado(Int $page_index, Int $page_size,$fecha_inicio, $fecha_fin):  ListaPaginacion
	{		
		$parametros = array(
			$page_index,
			$page_size,			
			$fecha_inicio,
			$fecha_fin				
		);

		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL sp_listar_nota_ingreso(?, ?, ?, ?)');
		$stmt->execute($parametros);
		$listaDocumentos = $stmt->fetchAll($dbh::FETCH_CLASS);
		$stmt->nextRowset();
		$total_registros = $stmt->fetchAll($dbh::FETCH_CLASS);
		$stmt->closeCursor();
		unset($stmt);
		unset($dbh);
		$totalRegistros = $total_registros[0]->total_registros;
		return new ListaPaginacion($listaDocumentos, $totalRegistros, $page_size, $page_index);

	}

	public static function Insertar_Actualizar(Array $datos): Object
	{
		$parametros = array(
			array_key_exists('movimientoid',$datos)? $datos['movimientoid']:NULL,			
			$datos['fechamovimiento'],
			$datos['nrodocumento'],			
			$datos['tipodocumento'],	
            $datos['razon'],		
			$datos['tipomovimiento'],	
			$datos['nronotaingreso'],	
			$datos['nronotasalida'],						
			$datos['user'],			
			$datos['xml']					
		);
		
		$res = DB::select("CALL sp_movimiento_ins_upd(?,?,?,?,?,?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}	

	public static function ListadoStock($almacenid, $productoid):  array
	{		
		$parametros = array(			
			$almacenid,		
			$productoid						
		);		
		$res = DB::select("CALL sp_stock_productos(?,?)",$parametros);
		return $res;
	}

	public static function MovimientosAlmacenProductos($almacenid,$productoid,$fecha_inicio,$fecha_fin):  array
	{		
		$parametros = array(			
			$almacenid,
			$productoid,
			$fecha_inicio,
			$fecha_fin								
		);		
		$res = DB::select("CALL sp_movimientos_almacen_productos(?,?,?,?)",$parametros);
		return $res;
	}
}