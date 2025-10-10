<?php

namespace App\Logic\Ventas;

use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Models\Ventas\VentasModel;

class VentasLogic
{
    public static function Eliminar(Int $id): RespuestaOperacion
    {
        $resultado = VentasModel::Eliminar($id);
        return new RespuestaOperacion(null, null, $resultado);
    }

    public static function PedidoGetMesaid(Int $mesaid): RespuestaOperacion
    {
        $resultado = VentasModel::PedidoGetMesaid($mesaid);
        if(General::isEmpty($resultado)){$resultado=NULL;}
        return new RespuestaOperacion($resultado);
    }

    public static function PedidoDetalleGetId(Int $pedidoid): RespuestaOperacion
    {      
        $lista = VentasModel::PedidoDetalleGetId($pedidoid);
        return new RespuestaOperacion($lista);
    }   
    
    public static function ObtenerDetalleDocVentaId(Int $docventaid): RespuestaOperacion
    {      
        $lista = VentasModel::ObtenerDetalleDocVentaId($docventaid);
        return new RespuestaOperacion($lista);
    }   

    public static function Listado(Int $page_index, Int $page_size,$estado, $fecha_inicio, $fecha_fin, $tipodocumentoid, $personalid
    ): RespuestaOperacion
    {
        if(General::isEmpty($estado)){ $estado = NULL;}
        if(General::isEmpty($fecha_inicio)){ $fecha_inicio = NULL;}
        if(General::isEmpty($fecha_fin)){ $fecha_fin = NULL;}   
        if(General::isEmpty($personalid)){ $personalid = NULL;} 
        if(General::isEmpty($tipodocumentoid)){ $tipodocumentoid = NULL;} 

        $resultado = VentasModel::Listado(
            $page_index, 
            $page_size, 
            $estado, 
            $fecha_inicio, 
            $fecha_fin, 
            $tipodocumentoid,
            $personalid           
        );
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $datos['xml'] = General::convertir_array_a_xml($datos['ventadetalle']);
        $resultado = VentasModel::Insertar_Actualizar($datos);
        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
        
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }

    public static function Actualizar_Docventa_NubeFact(Array $datos): RespuestaOperacion
    {       
        $resultado = VentasModel::Actualizar_Docventa_NubeFact($datos);
        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
        
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }

    public static function AnularVenta(Array $datos): RespuestaOperacion
    {
        $resultado = VentasModel::AnularVenta($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }

    public static function ActualizarVenta(Array $datos): RespuestaOperacion
    {
        $resultado = VentasModel::ActualizarVenta($datos);

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