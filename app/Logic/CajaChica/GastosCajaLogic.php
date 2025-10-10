<?php

namespace App\Logic\CajaChica;

use App\Clases\RespuestaOperacion;
use App\Models\CajaChica\GastosCajaModel;
use App\Clases\General;

class GastosCajaLogic
{   
    public static function Listado(Int $page_index, Int $page_size, 
    $fecha_inicio,$fecha_fin): RespuestaOperacion
    {    
        if(General::isEmpty($fecha_inicio)){$fecha_inicio = NULL;}   
        if(General::isEmpty($fecha_fin)){$fecha_fin = NULL;}    
      
        $resultado = GastosCajaModel::Listado( $page_index, $page_size,$fecha_inicio,$fecha_fin);
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $resultado = GastosCajaModel::Insertar_Actualizar($datos);

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