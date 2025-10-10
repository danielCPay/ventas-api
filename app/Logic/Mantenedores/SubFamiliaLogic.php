<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\SubFamiliaModel;
use App\Clases\General;

class SubFamiliaLogic
{
    public static function SubFamilia_Desplegable(): RespuestaOperacion
    {
        $lista = SubFamiliaModel::SubFamilia_Desplegable();
        return new RespuestaOperacion($lista);
    }   

    public static function SubFamiliaGetId(Int $familiaid): RespuestaOperacion
    {      
        $lista = SubFamiliaModel::SubFamiliaGetId($familiaid);
        return new RespuestaOperacion($lista);
    }    
    public static function Listado(Int $page_index, Int $page_size, 
    $descripcionsubfamilia): RespuestaOperacion
    {    
        if(General::isEmpty($descripcionsubfamilia)){ $descripcionsubfamilia = NULL;}    
      
        $resultado = SubFamiliaModel::Listado( $page_index, $page_size,$descripcionsubfamilia);
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $resultado = SubFamiliaModel::Insertar_Actualizar($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }
    public static function Anular(Array $datos): RespuestaOperacion
    {
        $resultado = SubFamiliaModel::Anular($datos);

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