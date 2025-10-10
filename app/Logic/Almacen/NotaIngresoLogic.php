<?php

namespace App\Logic\Almacen;

use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Models\Almacen\NotaIngresoModel;

class NotaIngresoLogic
{  

    public static function Listado(Int $page_index, Int $page_size,$fecha_inicio, $fecha_fin): RespuestaOperacion
    {       
        if(General::isEmpty($fecha_inicio)){ $fecha_inicio = NULL;}
        if(General::isEmpty($fecha_fin)){ $fecha_fin = NULL;}       

        $resultado = NotaIngresoModel::Listado(
            $page_index, 
            $page_size,            
            $fecha_inicio, 
            $fecha_fin            
        );
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $datos['xml'] = General::convertir_array_a_xml($datos['notaingresodetalle']);
        $resultado = NotaIngresoModel::Insertar_Actualizar($datos);
        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
        
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }       
    public static function NumeracionNotaIngreso(): RespuestaOperacion
    {
        $lista = NotaIngresoModel::NumeracionNotaIngreso();
        return new RespuestaOperacion($lista);
    }  

    public static function AnularNontaIngreso(Array $datos): RespuestaOperacion
    {
        $datos['xml'] = General::convertir_array_a_xml($datos['detallecompra']);
        $resultado = NotaIngresoModel::AnularNontaIngreso($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }
    public static function ObtenerDetalleNotaIngresoId(Int $notaentradaid): RespuestaOperacion
    {      
        $lista = NotaIngresoModel::ObtenerDetalleNotaIngresoId($notaentradaid);
        return new RespuestaOperacion($lista);
    }   

    public static function AnularNotaIngresoDetalle(Array $datos): RespuestaOperacion
    {
        $resultado = NotaIngresoModel::AnularNotaIngresoDetalle($datos);

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