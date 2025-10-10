<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\InsumoModel;
use App\Clases\General;

class InsumoLogic
{   
    public static function Listado(Int $page_index, Int $page_size, 
    $idSubCategoria,$descripcionInsumo): RespuestaOperacion
    {
        if(General::isEmpty($idSubCategoria)){ $idSubCategoria = NULL;}
        if(General::isEmpty($descripcionInsumo)){ $descripcionInsumo = NULL;}    
      
        $resultado = InsumoModel::Listado( $page_index, $page_size, $idSubCategoria,$descripcionInsumo);
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $resultado = InsumoModel::Insertar_Actualizar($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }

    public static function Obtener_Insumo(String $insumoid): RespuestaOperacion
    {
        $resultado = InsumoModel::Obtener_Insumo($insumoid);
        if(General::isEmpty($resultado)){$resultado=NULL;}
        return new RespuestaOperacion($resultado);
    }
    
}