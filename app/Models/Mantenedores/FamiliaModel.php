<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class FamiliaModel
{
    public static function Familia_Desplegable(): array
	{
		$res = DB::select("CALL sp_familia_listar()");
		return $res;
	}

}