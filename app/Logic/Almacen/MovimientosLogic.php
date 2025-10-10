<?php

namespace App\Logic\Almacen;

use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Models\Almacen\MovimientosModel;
use App\Models\Mantenedores\RecetaModel;
class MovimientosLogic
{  

    public static function Listado(Int $page_index, Int $page_size,$fecha_inicio, $fecha_fin): RespuestaOperacion
    {       
        if(General::isEmpty($fecha_inicio)){ $fecha_inicio = NULL;}
        if(General::isEmpty($fecha_fin)){ $fecha_fin = NULL;}       

        $resultado = MovimientosModel::Listado(
            $page_index, 
            $page_size,            
            $fecha_inicio, 
            $fecha_fin            
        );
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $datos['xml'] = General::convertir_array_a_xml($datos['movimientosdetalle']);
        $resultado = MovimientosModel::Insertar_Actualizar($datos);
        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
        
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }       
   
    public static function ListadoStock($almacenid, $productoid): RespuestaOperacion
    {       
        if(General::isEmpty($productoid)){ $productoid = NULL;}        
        if(General::isEmpty($almacenid)){ $almacenid = NULL;} 

        $resultado = MovimientosModel::ListadoStock(                
            $almacenid,     
            $productoid             
        );
        return new RespuestaOperacion($resultado);
    }
    public static function MovimientosAlmacenProductos($almacenid,$productoid,$fecha_inicio,$fecha_fin): RespuestaOperacion
    {       
        if(General::isEmpty($almacenid)){ $almacenid = NULL;}        
        if(General::isEmpty($productoid)){ $productoid = NULL;}   
        if(General::isEmpty($fecha_inicio)){ $fecha_inicio = NULL;}    
        if(General::isEmpty($fecha_fin)){ $fecha_fin = NULL;}     

        $resultado = MovimientosModel::MovimientosAlmacenProductos(                
            $almacenid,
            $productoid,
            $fecha_inicio,
            $fecha_fin                        
        );
        return new RespuestaOperacion($resultado);
    }
}