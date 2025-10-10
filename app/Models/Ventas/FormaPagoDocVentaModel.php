<?php

namespace App\Models\Ventas;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class FormaPagoDocVentaModel
{
   
	public static function Listado(
		Int $page_index, Int $page_size, 
		$nroExpediente, $idTramite, $nroDocumento, $idTipoDocumento, $nombreApellido):  ListaPaginacion
	{
		$parametros = array(
			$page_index,
			$page_size,
			$nroExpediente,
			$idTramite,
			$nroDocumento,
			$idTipoDocumento,
			$nombreApellido
		);

		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL PROC_SISTRAM__EXPEDIENTE__LIST(?, ?, ?, ?, ?, ?, ?)');
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
			$datos['numdoc'],
			$datos['fechapago'],			
			$datos['tipocambio'],
            $datos['user'],	          
			$datos['xml']			
		);
		
		$res = DB::select("CALL sp_formapagodocventa_ins_upd(?,?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}

}