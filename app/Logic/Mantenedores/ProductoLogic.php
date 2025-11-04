<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\ProductoModel;
use App\Clases\General;

class ProductoLogic
{   
    public static function Listado(Int $page_index, Int $page_size, 
    $idSubFamilia,$descripcionProducto): RespuestaOperacion
    {
        if(General::isEmpty($idSubFamilia)){ $idSubFamilia = NULL;}
        if(General::isEmpty($descripcionProducto)){ $descripcionProducto = NULL;}    
      
        $resultado = ProductoModel::Listado( $page_index, $page_size, $idSubFamilia,$descripcionProducto);
        return new RespuestaOperacion($resultado);
    }

    public static function ListadoProductosPresentacion(Int $page_index, Int $page_size, 
    $idSubFamilia,$descripcionProducto): RespuestaOperacion
    {
        if(General::isEmpty($idSubFamilia)){ $idSubFamilia = NULL;}
        if(General::isEmpty($descripcionProducto)){ $descripcionProducto = NULL;}    
      
        $resultado = ProductoModel::ListadoProductosPresentacion( $page_index, $page_size, $idSubFamilia,$descripcionProducto);
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $resultado = ProductoModel::Insertar_Actualizar($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }

    public static function TopProductos(Int $mes, Int $anio): RespuestaOperacion
    {      
        $lista = ProductoModel::TopProductos($mes,$anio);
        return new RespuestaOperacion($lista);
    }    

    public static function Obtener_Producto(String $productoid): RespuestaOperacion
    {
        $resultado = ProductoModel::Obtener_Producto($productoid);
        if(General::isEmpty($resultado)){$resultado=NULL;}
        return new RespuestaOperacion($resultado);
    }
    public static function Anular(Array $datos): RespuestaOperacion
    {
        $resultado = ProductoModel::Anular($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }
    public static function Obtener_Presentacion_Codigo(String $codigo): RespuestaOperacion
    {
        $resultado = ProductoModel::Obtener_Presentacion_Codigo($codigo);
        if(General::isEmpty($resultado)){$resultado=NULL;}
        return new RespuestaOperacion($resultado);
    }
}