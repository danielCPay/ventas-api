<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class SubFamiliaModel
{
    public static function SubFamilia_Desplegable(): array
	{
		$res = DB::select("CALL sp_subfamilia_desplegable()");
		return $res;
	}
	public static function SubFamiliaGetId(Int $familiaid): array
	{
		$res = DB::select("CALL sp_subfamilia_getId(?)",[$familiaid]);
		return $res;
		
	}
	public static function Listado(Int $page_index, Int $page_size,$descripcionSubFamilia):  ListaPaginacion
	{   
        $parametros = array(
			$page_index,
			$page_size,			
            $descripcionSubFamilia
		);
		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL sp_subfamilia_listar(?, ?, ?)');
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
			array_key_exists('subfamiliaid',$datos)? $datos['subfamiliaid']:NULL,			
			$datos['descripcionsubfamilia']							
		);
		$res = DB::select("CALL sp_subfamilia_ins_upd(?,?)",$parametros);
		return $res[0] ?? null;
	}
	public static function Anular(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['subfamiliaid'],
			$datos['user']										
		);
		$res = DB::select("CALL sp_subfamilia_anular(?,?)",$parametros);
		return $res[0] ?? null;
	}

}