<?php

namespace App\Models\Almacen;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class NotaIngresoModel
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
			array_key_exists('notaentradaid',$datos)? $datos['notaentradaid']:NULL,			
			$datos['fechaentrada'],
			$datos['monedaid'],			
			$datos['nrodocumentoingreso'],	
            $datos['proveedorid'],		
			$datos['conceptomovimientoid'],	
			$datos['almacenid'],	
			$datos['seriefactura'],	
			$datos['numfactura'],	
			$datos['serieguia'],	
			$datos['numguia'],	
			$datos['observacion'],				
			$datos['user'],		
			$datos['doccompraid'],	
			$datos['xml']					
		);
		
		$res = DB::select("CALL sp_notaingreso_ins_upd(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}	

	public static function NumeracionNotaIngreso(): Object
	{		
		$res = DB::select("CALL sp_numeracion_nota_ingreso(@n_numero_notaingreso)");
		return $res[0] ?? new \stdClass();
	}

	public static function AnularNontaIngreso(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['notaentradaid'],
			$datos['nrodocumentoingreso'],			
			$datos['user'],
			$datos['doccompraid'],	
			$datos['xml']											
		);
		$res = DB::select("CALL sp_notaingreso_anular(?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}

	public static function ObtenerDetalleNotaIngresoId(Int $notaentradaid): Array
	{
		$parametros = array(
			$notaentradaid
		);
		$res = DB::select("CALL sp_nota_ingreso_detalle_byid(?)",$parametros);
		return $res;
	}

	public static function AnularNotaIngresoDetalle(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['notaentradadetalleid'],
			$datos['productoid'],
			$datos['movimientoid']										
		);
		$res = DB::select("CALL sp_notaingreso_detalle_anular(?,?,?)",$parametros);
		return $res[0] ?? null;
	}
	

}