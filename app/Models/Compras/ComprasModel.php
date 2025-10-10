<?php

namespace App\Models\Compras;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class ComprasModel
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
		$stmt = $dbh->prepare('CALL sp_listar_compras(?, ?, ?, ?)');
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
	public static function ListarComprasProvisionar(Int $page_index, Int $page_size,$fecha_inicio, $fecha_fin):  ListaPaginacion
	{		
		$parametros = array(
			$page_index,
			$page_size,			
			$fecha_inicio,
			$fecha_fin				
		);

		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL sp_listar_compras_provisionar(?, ?, ?, ?)');
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
			array_key_exists('doccompraid',$datos)? $datos['doccompraid']:NULL,			
			$datos['fechacomprobante'],
			$datos['fecharecepcion'],			
			$datos['monedaid'],	
            $datos['condicionespagoid'],		
			$datos['tipocomprobanteid'],	
			$datos['proveedorid'],	
			$datos['seriecomprobante'],	
			$datos['numcomprobante'],	
			$datos['observacion'],	
			$datos['igv'],	
			$datos['importe'],
			$datos['total'],	
			$datos['diascredito'],		
			$datos['user'],			
			$datos['xml']					
		);
		
		$res = DB::select("CALL sp_compra_ins_upd(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}	

	public static function ObtenerDetalleDocCompraId(Int $doccompraid): Array
	{
		$parametros = array(
			$doccompraid
		);
		$res = DB::select("CALL sp_compra_detalle_byid(?)",$parametros);
		return $res;
	}

	public static function ObtenerDetalleDocCompraProvionarId(Int $doccompraid): Array
	{
		$parametros = array(
			$doccompraid
		);
		$res = DB::select("CALL sp_compra_provionar_detalle_byid(?)",$parametros);
		return $res;
	}

	public static function AnularCompra(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['doccompraid'],
			$datos['user']										
		);
		$res = DB::select("CALL sp_compra_anular(?,?)",$parametros);
		return $res[0] ?? null;
	}

	public static function AnularCompraDetalle(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['doccompraid'],
			$datos['productoid'],
			$datos['user']										
		);
		$res = DB::select("CALL sp_compra_detalle_anular(?,?,?)",$parametros);
		return $res[0] ?? null;
	}

	public static function CondicionesPagoDesplegable(): array
	{
		$res = DB::select("CALL sp_condiciones_pago_desplegar()");
		return $res;
	}
	public static function ExisteNumFactCompra(String $seriecomprobante,
	String $numcomprobante,Int $tipocomprobanteid,Int $proveedorid): Object
	{
		$parametros = array(
			$seriecomprobante,	
			$numcomprobante,		
			$tipocomprobanteid,		
			$proveedorid				
		);
		$res = DB::select("CALL sp_existe_num_fact_compra(?,?,?,?)",$parametros);
		return $res[0] ?? new \stdClass();
	}

}