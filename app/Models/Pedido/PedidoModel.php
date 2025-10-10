<?php

namespace App\Models\Pedido;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class PedidoModel
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
		$parametros=array($pedidoid);
		$res = DB::select("CALL sp_pedidodetalle_getid(?)",$parametros);
		return $res;
		
	}
	
	public static function Listado(
		Int $page_index, Int $page_size, 
		$estado, $fecha_inicio, $fecha_fin, $personalid):  ListaPaginacion
	{
		$parametros = array(
			$page_index,
			$page_size,
			$estado,
			$fecha_inicio,
			$fecha_fin,
			$personalid			
		);

		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL sp_listar_pedidos(?, ?, ?, ?, ?, ?)');
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
			array_key_exists('pedidoid',$datos)? $datos['pedidoid']:NULL,			
			$datos['fechapedido'],
			$datos['mesaid'],			
			$datos['estado'],	
            $datos['user'],		
			$datos['personalid'],	
			$datos['xml']			
		);
		
		$res = DB::select("CALL sp_pedido_ins_upd(?,?,?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}

	public static function ActualizarEstadoPedido(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['pedidoid'],
			$datos['estado']							
		);
		$res = DB::select("CALL sp_estado_pedido_upd(?,?)",$parametros);
		return $res[0] ?? null;
	}

	public static function ActualizarMesaPedido(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['pedidoid'],
			$datos['mesaid']							
		);
		$res = DB::select("CALL sp_mesa_pedido_upd(?,?)",$parametros);
		return $res[0] ?? null;
	}

	public static function AnularPedidoDetalle(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['pedidoid'],
			$datos['productoid'],
			$datos['codusu'],
			$datos['observacion']							
		);
		$res = DB::select("CALL sp_pedido_detalle_anular(?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}

	public static function TransferirPedido(Array $datos): Object
	{
		$parametros = array(
			array_key_exists('pedidoid',$datos)? $datos['pedidoid']:NULL,			
			$datos['productoid'],
			$datos['nitem'],			
			$datos['cantidad'],	
            $datos['enviado'],		
			$datos['estado'],	
			$datos['mensajecocina'],
			$datos['usercr']				
		);
		
		$res = DB::select("CALL sp_transferir_pedido(?,?,?,?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}

}