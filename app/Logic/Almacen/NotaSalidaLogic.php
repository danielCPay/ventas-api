<?php

namespace App\Logic\Almacen;

use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Models\Almacen\NotaSalidaModel;

class NotaSalidaLogic
{  

    public static function Listado(Int $page_index, Int $page_size,$fecha_inicio, $fecha_fin): RespuestaOperacion
    {       
        if(General::isEmpty($fecha_inicio)){ $fecha_inicio = NULL;}
        if(General::isEmpty($fecha_fin)){ $fecha_fin = NULL;}       

        $resultado = NotaSalidaModel::Listado(
            $page_index, 
            $page_size,            
            $fecha_inicio, 
            $fecha_fin            
        );
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $datos['xml'] = General::convertir_array_a_xml($datos['notasalidadetalle']);
        $resultado = NotaSalidaModel::Insertar_Actualizar($datos);
        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
        
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }       
    public static function NumeracionNotaSalida(): RespuestaOperacion
    {
        $lista = NotaSalidaModel::NumeracionNotaSalida();
        return new RespuestaOperacion($lista);
    }  

    public static function AnularNotaSalida(Array $datos): RespuestaOperacion
    {
        $resultado = NotaSalidaModel::AnularNotaSalida($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }
    public static function ObtenerDetalleNotaSalidaId(Int $notasalidaid): RespuestaOperacion
    {      
        $lista = NotaSalidaModel::ObtenerDetalleNotaSalidaId($notasalidaid);
        return new RespuestaOperacion($lista);
    }   

    public static function AnularNotaSalidaDetalle(Array $datos): RespuestaOperacion
    {
        $resultado = NotaSalidaModel::AnularNotaSalidaDetalle($datos);

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