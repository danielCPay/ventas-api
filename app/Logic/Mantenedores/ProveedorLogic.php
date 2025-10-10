<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\ProveedorModel;
use App\Clases\General;

class ProveedorLogic
{   
    public static function Listado(Int $page_index, Int $page_size, 
    $razonsocial): RespuestaOperacion
    {    
        if(General::isEmpty($razonsocial)){ $razonsocial = NULL;}    
      
        $resultado = ProveedorModel::Listado( $page_index, $page_size,$razonsocial);
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $resultado = ProveedorModel::Insertar_Actualizar($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }
    public static function Anular(Array $datos): RespuestaOperacion
    {
        $resultado = ProveedorModel::Anular($datos);

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