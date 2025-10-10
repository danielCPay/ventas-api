<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class MesaModel
{
	public static function ListarMesasPisoById(Int $pisoid): array
	{
		$res = DB::select("CALL sp_mesa_listar_piso(?)",[$pisoid]);
		return $res;
		
	}
	public static function ActualizarEstadoMesa(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['mesaid'],
			$datos['estadodisponibilidad']							
		);
		$res = DB::select("CALL sp_estado_mesa_upd(?,?)",$parametros);
		return $res[0] ?? null;
	}
	public static function Listado(Int $page_index, Int $page_size, 
	$descripcionmesa, $pisoid):  ListaPaginacion
	{   
        $parametros = array(
			$page_index,
			$page_size,			
            $descripcionmesa,
			$pisoid
		);
		$dbh = DB::getPdo();
		$dbh->setAttribute($dbh::ATTR_EMULATE_PREPARES, true);
		$stmt = $dbh->prepare('CALL sp_mesa_listar(?, ?, ? , ?)');
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
			array_key_exists('mesaid',$datos)? $datos['mesaid']:NULL,			
			$datos['descripcionmesa'],
			$datos['pisoid'],
			$datos['user']						
		);
		$res = DB::select("CALL sp_mesa_ins_upd(?,?,?,?)",$parametros);
		return $res[0] ?? null;
	}	

	public static function Anular(Int $id, String $user): Bool
	{
		$parametros = array(
			$id,
			$user
		);
		$res = DB::select("CALL sp_mesa_anular(?,?)",$parametros);
		return true;
	}


}