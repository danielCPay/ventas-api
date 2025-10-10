<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class InsumoModel
{
    public static function Listado(Int $page_index, Int $page_size, 
	$idSubCategoria,$descripcionInsumo):  ListaPaginacion
	{   
        $parametros = array(
			$page_index,
			$page_size,
			$idSubCategoria,
            $descripcionInsumo
		);
		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL sp_insumo_listar(?, ?, ?, ?)');
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
			array_key_exists('insumoid',$datos)? $datos['insumoid']:NULL,			
			$datos['descripcioninsumo'],
			$datos['costo'],
			$datos['unidadmedidaid'],
			$datos['subcategoriaid']						
		);
		$res = DB::select("CALL sp_insumo_ins_upd(?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}	

	public static function Obtener_Insumo(Int $insumoid): Object
	{
		$parametros = array(
			$insumoid			
		);
		$res = DB::select("CALL sp_obtener_insumo(?)",$parametros);
		return $res[0] ?? new \stdClass();
	}

}