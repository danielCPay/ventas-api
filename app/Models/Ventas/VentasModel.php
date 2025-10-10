<?php

namespace App\Models\Ventas;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class VentasModel
{
    public static function Eliminar(Int $id): Bool
	{
		$parametros = array(
			$id
		);
		$res = DB::select("CALL PROC_SISTRAM__EXPEDIENTE__DEL(?)",$parametros);
		return true;
	}

	public static function PedidoGetMesaid(Int $mesaid): Object
	{
		$parametros = array(
			$mesaid			
		);
		$res = DB::select("CALL sp_pedido_getmesaid(?)",$parametros);
		return $res[0] ?? new \stdClass();
	}

	public static function PedidoDetalleGetId(Int $pedidoid): array
	{
		$res = DB::select("CALL sp_pedidodetalle_getid(?)",[$pedidoid]);
		return $res;
		
	}
	
	public static function Listado(Int $page_index, Int $page_size, $estado, $fecha_inicio, $fecha_fin, $tipodocumentoid, $personalid):  ListaPaginacion
	{		
		$parametros = array(
			$page_index,
			$page_size,
			$estado,
			$fecha_inicio,
			$fecha_fin,
			$tipodocumentoid,
			$personalid			
		);

		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL sp_listar_ventas(?, ?, ?, ?, ?, ? , ?)');
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
			array_key_exists('docventaid',$datos)? $datos['docventaid']:NULL,				
			$datos['clienteid'],			
			$datos['monedaid'],	
            $datos['igv'],		
			$datos['importe'],	
			$datos['total'],	
			$datos['tipocomprobanteid'],				
			$datos['fecha'],	
			$datos['numdoc'],
			$datos['nroliquidacion'],
			$datos['nrcaja'],
			$datos['estado'],
			$datos['user'],				
			$datos['xml']			
		);
		
		$res = DB::select("CALL sp_venta_ins_upd(?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}

	public static function Actualizar_Docventa_NubeFact(Array $datos): Object
	{
		$parametros = array(
			array_key_exists('docventaid',$datos)? $datos['docventaid']:NULL,			
			$datos['aceptada_por_sunat'],
			$datos['sunat_description'],			
			$datos['enlace'],	
            $datos['enlace_del_cdr'],		
			$datos['enlace_del_pdf'],	
			$datos['enlace_del_xml']				
		);
		
		$res = DB::select("CALL sp_actualizar_docventa_nubefact(?,?,?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}

	public static function ObtenerDocVentaId(Int $docventaid): Object
	{
		$parametros = array(
			$docventaid
		);
		$res = DB::select("CALL sp_obtener_docventaId(?)",$parametros);
		return $res[0] ?? new \stdClass();
	}

	public static function ObtenerDetalleDocVentaId(Int $docventaid): Array
	{
		$parametros = array(
			$docventaid
		);
		$res = DB::select("CALL sp_obtener_detalle_docventaId(?)",$parametros);
		return $res;
	}

	public static function AnularVenta(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['docventaid'],
			$datos['user'],
			$datos['observacion']								
		);
		$res = DB::select("CALL sp_venta_anular(?,?,?)",$parametros);
		return $res[0] ?? null;
	}

	public static function ActualizarVenta(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['docventaid'],
			$datos['user'],
			$datos['clienteid']								
		);
		$res = DB::select("CALL sp_venta_actualizar(?,?,?)",$parametros);
		return $res[0] ?? null;
	}


}