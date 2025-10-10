<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class FormaPagoModel
{
    public static function Forma_Pago_Desplegable(): array
	{
		$res = DB::select("CALL sp_formapago_desplegable()");
		return $res;
	}

}