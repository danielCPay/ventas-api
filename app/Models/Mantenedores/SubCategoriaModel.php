<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class SubCategoriaModel
{
    public static function SubCategoria_Desplegable(): array
	{
		$res = DB::select("CALL sp_subcategoria_listar()");
		return $res;
	}

}