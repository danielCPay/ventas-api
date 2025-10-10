<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class PersonalModel
{
    public static function Listado(Int $page_index, Int $page_size, 
	$nombres):  ListaPaginacion
	{   
        $parametros = array(
			$page_index,
			$page_size,			
            $nombres
		);
		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL sp_per_listar(?, ?, ?)');
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
			array_key_exists('personalid',$datos)? $datos['personalid']:NULL,			
			$datos['nombres'],
			$datos['apellidos'],
			$datos['dni'],
			$datos['direccion'],
            $datos['telefono'],
			$datos['cargoid']						
		);
		$res = DB::select("CALL sp_per_ins_upd(?,?,?,?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}
	public static function Personal_Desplegable(): array
	{
		$res = DB::select("CALL sp_personal_select()");
		return $res;
	}
	public static function Anular(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['personalid'],
			$datos['user']										
		);
		$res = DB::select("CALL sp_personal_anular(?,?)",$parametros);
		return $res[0] ?? null;
	}

}