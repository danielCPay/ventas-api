<?php

namespace App\Clases;

class RespuestaOperacion
{
	public $datos;
	public $mensaje;
	public $exito;
	public function __construct($datos = null, $mensaje = '' , $exito = true){
		$this->mensaje = $mensaje;
		$this->datos = $datos;
		$this->exito = $exito;
	}
	public static function enviarJson($datos = null, $mensaje = '', $exito = null){
		if (is_null($exito))
			$exito = ($mensaje == '');
		$mensaje = new RespuestaOperacion($datos, $mensaje, $exito);
		//\App\Models\Log::guardar_response(json_encode($mensaje, TRUE));
		return json_encode($mensaje, TRUE);
	}
	public static function enviarJsonObj(RespuestaOperacion $respuestaOperacion){
		return json_encode($respuestaOperacion, TRUE);
	}
}
