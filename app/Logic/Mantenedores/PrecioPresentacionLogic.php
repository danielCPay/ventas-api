<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\PrecioPresentacionModel;
use App\Clases\General;

class PrecioPresentacionLogic
{   
    
    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {      
        $resultado = PrecioPresentacionModel::Insertar_Actualizar($datos);
        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
        
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }
   
    public static function ListadoPreciosPresentacion(Int $productoid): RespuestaOperacion
    {      
        $lista = PrecioPresentacionModel::ListadoPreciosPresentacion($productoid);
        return new RespuestaOperacion($lista);
    }    

}