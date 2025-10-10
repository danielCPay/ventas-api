<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class AlmacenModel
{
    public static function Almacen_Desplegable(): array
	{
		$res = DB::select("CALL sp_almacen_listar()");
		return $res;
	}

}