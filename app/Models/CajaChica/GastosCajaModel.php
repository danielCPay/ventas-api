<?php

namespace App\Models\CajaChica;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class GastosCajaModel
{
	public static function Listado(
		Int $page_index,
		Int $page_size,
		$fecha_inicio,
		$fecha_fin
	): ListaPaginacion {
		$parametros = array(
			$page_index,
			$page_size,
			$fecha_inicio,
			$fecha_fin,
		);
		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL sp_gastos_listar(?, ?, ? , ?)');
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

	public static function Insertar_Actualizar(array $datos): Object
	{
		$parametros = array(
			array_key_exists('gastosid', $datos) ? $datos['gastosid'] : NULL,
			$datos['fecha'],
			$datos['concepto'],
			$datos['monto'],
			$datos['moneda'],
			$datos['descripcion'],
			$datos['nroliquidacion'],
			$datos['nrcaja'],
			$datos['user']
		);
		$res = DB::select("CALL sp_gastos_ins_upd(?,?,?,?,?,?,?,?,?)", $parametros);
		return $res[0] ?? null;
	}
}
