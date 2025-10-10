<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class TarjetaCreditoFormaPagoModel
{
    public static function TarjetaCredito_FormaPago_Desplegable($formapagoid): array
	{
		$res = DB::select("CALL sp_tajetacreditoformapago_desplegable(?)",[$formapagoid]);
		return $res;
	}

}