<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class CargoModel
{
    public static function Cargo_Desplegable(): array
	{
		$res = DB::select("CALL sp_cargo_listar()");
		return $res;
	}

}