<?php

namespace App\Models\Mantenedores;

use Illuminate\Support\Facades\DB;
use App\Clases\ListaPaginacion;

class UsuarioModel
{
    public static function Login(String $usuario,String $contrasena): Object
	{
		$parametros = array(
			$usuario,
			$contrasena					
		);

		$res = DB::select("CALL sp_usuario_login(?,?)",$parametros);
		return $res[0] ?? new \stdClass();
	}

}