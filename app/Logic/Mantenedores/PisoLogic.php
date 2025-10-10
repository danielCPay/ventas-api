<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\PisoModel;
use App\Clases\General;

class PisoLogic
{
    public static function Piso_Desplegable(): RespuestaOperacion
    {
        $lista = PisoModel::Piso_Desplegable();
        return new RespuestaOperacion($lista);
    }  
    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $resultado = PisoModel::Insertar_Actualizar($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    } 

}