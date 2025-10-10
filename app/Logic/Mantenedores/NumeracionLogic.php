<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\NumeracionModel;
use App\Clases\General;

class NumeracionLogic
{
    public static function NumeracionComprobante(Int $tipodocumento,$razon): RespuestaOperacion
    {
        $lista = NumeracionModel::NumeracionComprobante($tipodocumento,$razon);
        return new RespuestaOperacion($lista);
    }   
    public static function Actualizar_Ultimo_Numero_Usado(Array $datos): RespuestaOperacion
    {
        $resultado = NumeracionModel::Actualizar_Ultimo_Numero_Usado($datos);

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