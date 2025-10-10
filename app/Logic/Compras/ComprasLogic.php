<?php

namespace App\Logic\Compras;

use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Models\Compras\ComprasModel;

class ComprasLogic
{  

    public static function Listado(Int $page_index, Int $page_size,$fecha_inicio, $fecha_fin): RespuestaOperacion
    {       
        if(General::isEmpty($fecha_inicio)){ $fecha_inicio = NULL;}
        if(General::isEmpty($fecha_fin)){ $fecha_fin = NULL;}       

        $resultado = ComprasModel::Listado(
            $page_index, 
            $page_size,            
            $fecha_inicio, 
            $fecha_fin            
        );
        return new RespuestaOperacion($resultado);
    }
    public static function ListarComprasProvisionar(Int $page_index, Int $page_size,$fecha_inicio, $fecha_fin): RespuestaOperacion
    {       
        if(General::isEmpty($fecha_inicio)){ $fecha_inicio = NULL;}
        if(General::isEmpty($fecha_fin)){ $fecha_fin = NULL;}       

        $resultado = ComprasModel::ListarComprasProvisionar(
            $page_index, 
            $page_size,            
            $fecha_inicio, 
            $fecha_fin            
        );
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $datos['xml'] = General::convertir_array_a_xml($datos['compradetalle']);
        $resultado = ComprasModel::Insertar_Actualizar($datos);
        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
        
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }    

    public static function AnularCompra(Array $datos): RespuestaOperacion
    {
        $resultado = ComprasModel::AnularCompra($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }
    public static function AnularCompraDetalle(Array $datos): RespuestaOperacion
    {
        $resultado = ComprasModel::AnularCompraDetalle($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }
    
    public static function ObtenerDetalleDocCompraId(Int $doccompraid): RespuestaOperacion
    {      
        $lista = ComprasModel::ObtenerDetalleDocCompraId($doccompraid);
        return new RespuestaOperacion($lista);
    }   

    public static function ObtenerDetalleDocCompraProvionarId(Int $doccompraid): RespuestaOperacion
    {      
        $lista = ComprasModel::ObtenerDetalleDocCompraProvionarId($doccompraid);
        return new RespuestaOperacion($lista);
    }  

    public static function CondicionesPagoDesplegable(): RespuestaOperacion
    {
        $lista = ComprasModel::CondicionesPagoDesplegable();
        return new RespuestaOperacion($lista);
    }   

    public static function ExisteNumFactCompra(String $seriecomprobante,
	String $numcomprobante,Int $tipocomprobanteid,Int $proveedorid): RespuestaOperacion
    {
        $resultado = ComprasModel::ExisteNumFactCompra($seriecomprobante,
        $numcomprobante,$tipocomprobanteid,$proveedorid);
        if(General::isEmpty($resultado)){$resultado=NULL;}
        return new RespuestaOperacion($resultado);
    }


}