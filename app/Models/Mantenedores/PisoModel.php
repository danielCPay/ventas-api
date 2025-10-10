<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class PisoModel
{	

	public static function Piso_Desplegable(): array
	{
		$res = DB::select("CALL sp_piso_listar()");
		return $res;
	}

	public static function Insertar_Actualizar(Array $datos): Object
	{		       
		$parametros = array(
			array_key_exists('pisoid',$datos)? $datos['pisoid']:NULL,			
			$datos['descripcionpiso']							
		);
		$res = DB::select("CALL sp_piso_ins_upd(?,?)",$parametros);
		return $res[0] ?? null;
	}

}