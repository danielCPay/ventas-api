<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class ConceptoMovimientoModel
{
    public static function Concepto_Movimiento_Desplegable(): array
	{
		$res = DB::select("CALL sp_concepto_movimiento_listar()");
		return $res;
	}

}