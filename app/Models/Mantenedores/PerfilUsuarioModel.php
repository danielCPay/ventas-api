<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class PerfilUsuarioModel
{
    public static function Perfil_Desplegable(): array
	{
		$res = DB::select("CALL sp_perfiles_usuario()");
		return $res;
	}

}