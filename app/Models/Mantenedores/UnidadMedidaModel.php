<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class UnidadMedidaModel
{
    public static function Unidad_Medida_Desplegable(): array
	{
		$res = DB::select("CALL sp_unidad_medida_listar()");
		return $res;
	}

}