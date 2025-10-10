<?php

namespace App\Logic\Pedido;

use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Models\Pedido\PedidoModel;

class PedidoLogic
{
    public static function Eliminar(Int $id): RespuestaOperacion
    {
        $resultado = PedidoModel::Eliminar($id);
        return new RespuestaOperacion(null, null, $resultado);
    }

    public static function PedidoGetMesaid(Int $mesaid): RespuestaOperacion
    {
        $resultado = PedidoModel::PedidoGetMesaid($mesaid);
        if(General::isEmpty($resultado)){$resultado=NULL;}
        return new RespuestaOperacion($resultado);
    }

    public static function PedidoDetalleGetId(Int $pedidoid): RespuestaOperacion
    {      
        $lista = PedidoModel::PedidoDetalleGetId($pedidoid);
        return new RespuestaOperacion($lista);
    }    

    public static function Listado(
        Int $page_index, Int $page_size, 
		$estado, $fecha_inicio, $fecha_fin, $personalid
    ): RespuestaOperacion
    {

        if(General::isEmpty($estado)){ $estado = NULL;}
        if(General::isEmpty($fecha_inicio)){ $fecha_inicio = NULL;}
        if(General::isEmpty($fecha_fin)){ $fecha_fin = NULL;}
        if(General::isEmpty($personalid)){ $personalid = NULL;}
       
        $resultado = PedidoModel::Listado(
            $page_index, $page_size, 
            $estado, $fecha_inicio, $fecha_fin, $personalid
        );
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $datos['xml'] = General::convertir_array_a_xml($datos['pedidodetalle']);
        $resultado = PedidoModel::Insertar_Actualizar($datos);
        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
        
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }

    public static function ActualizarEstadoPedido(Array $datos): RespuestaOperacion
    {
        $resultado = PedidoModel::ActualizarEstadoPedido($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }

    public static function ActualizarMesaPedido(Array $datos): RespuestaOperacion
    {
        $resultado = PedidoModel::ActualizarMesaPedido($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }

    public static function AnularPedidoDetalle(Array $datos): RespuestaOperacion
    {
        $resultado = PedidoModel::AnularPedidoDetalle($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }

    public static function TransferirPedido(Array $datos): RespuestaOperacion
    {       
        $resultado = PedidoModel::TransferirPedido($datos);
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