<?php

namespace App\Models\Almacen;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class NotaSalidaModel
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
		$stmt = $dbh->prepare('CALL sp_listar_nota_salida(?, ?, ?, ?)');
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
			array_key_exists('notasalidaid',$datos)? $datos['notasalidaid']:NULL,			
			$datos['fechasalida'],
			$datos['nrodocumentosalida'],			
			$datos['personalid'],	
            $datos['conceptomovimientoid'],		
			$datos['almacenid'],	
			$datos['razon'],	
			$datos['destino'],	
			$datos['observacion'],	
			$datos['user'],				
			$datos['xml']					
		);
		
		$res = DB::select("CALL sp_notasalida_ins_upd(?,?,?,?,?,?,?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}	

	public static function NumeracionNotaSalida(): Object
	{		
		$res = DB::select("CALL sp_numeracion_nota_salida(@n_numero_notasalida)");
		return $res[0] ?? new \stdClass();
	}

	public static function AnularNotaSalida(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['notasalidaid'],
			$datos['nrodocumentosalida'],			
			$datos['user']										
		);
		$res = DB::select("CALL sp_notasalida_anular(?,?,?)",$parametros);
		return $res[0] ?? null;
	}	
	public static function ObtenerDetalleNotaSalidaId(Int $notasalidaid): Array
	{
		$parametros = array(
			$notasalidaid
		);
		$res = DB::select("CALL sp_nota_salida_detalle_byid(?)",$parametros);
		return $res;
	}

	public static function AnularNotaSalidaDetalle(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['notasalidadetalleid'],
			$datos['productoid'],
			$datos['movimientoid']										
		);
		$res = DB::select("CALL sp_notasalida_detalle_anular(?,?,?)",$parametros);
		return $res[0] ?? null;
	}

}