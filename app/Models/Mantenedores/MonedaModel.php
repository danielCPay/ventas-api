<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class MonedaModel
{
    public static function Moneda_Desplegable(): array
	{
		$res = DB::select("CALL sp_moneda_listar()");
		return $res;
	}

}