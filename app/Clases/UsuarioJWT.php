<?php

namespace App\Clases;

use \Firebase\JWT\JWT;
use Carbon\Carbon;
use DB;

class UsuarioJWT
{
	public $id;
	public $jwt_fecha_creacion;

	public static $ROL_COLEGIADO = "C"; // COLEGIADO
	public static $ROL_EXTERNO = "E"; // EXTERNO
	public static $ROL_INVITADO = "I"; // INVITADO
	public static $ROL_ADMIN = "A"; // INVITADO

	public function __construct(Array $datos = [])
	{
		$this->id = null;
		$this->jwt_fecha_creacion = Carbon::now()->toDateTimeString();
		if (isset($datos['id']))
			$this->id = $datos['id'];
	}

	public function usuario_a_jwt()
	{
		$JWT_KEY = env('JWT_KEY');
		$JWT_ALGORITHM = env('JWT_ALGORITHM');
		$fecha_creacion = Carbon::now()->toDateTimeString();
		$payload = [
			'id' => $this->id,
			'jwt_fecha_creacion' => $fecha_creacion
		];
		return JWT::encode($payload, $JWT_KEY, $JWT_ALGORITHM);
	}

	public static function jwt_a_usuario($jwt)
	{
		$JWT_KEY = env('JWT_KEY');
		$JWT_ALGORITHM = env('JWT_ALGORITHM');
		$datos = JWT::decode($jwt, $JWT_KEY, array($JWT_ALGORITHM));
		return new UsuarioJWT([
			'id' => $datos->id ?? null,
			'jwt_fecha_creacion' => $datos->jwt_fecha_creacion
		]);
	}
}
