<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class TipoComprobanteModel
{
    public static function TipoComprobante_Desplegable($proceso): array
	{
		$res = DB::select("CALL sp_tipo_comprobante_listar(?)",[$proceso]);
		return $res;
	}

}