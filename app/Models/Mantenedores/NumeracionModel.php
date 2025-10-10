<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class NumeracionModel
{
    public static function NumeracionComprobante(Int $tipodocumento,$razon): Object
	{
		$parametros = array(
			$tipodocumento,
			$razon
		);

		$res = DB::select("CALL sp_numeracion_comprobantes(?,?,@n_numerodocumento)",$parametros);
		return $res[0] ?? new \stdClass();
	}

	public static function Actualizar_Ultimo_Numero_Usado(Array $datos): Object
	{		       
		$parametros = array(				
			$datos['tipodocumentoid'],
			$datos['razon'],
			$datos['ultimonumerousado']
					
		);
		$res = DB::select("CALL sp_ultimo_numero_usado_upd(?,?,?)",$parametros);
		return $res[0] ?? null;
	}

}