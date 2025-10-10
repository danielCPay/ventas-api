<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\PersonalModel;
use App\Clases\General;

class PersonalLogic
{   
    public static function Listado(Int $page_index, Int $page_size, 
    $nombres): RespuestaOperacion
    {    
        if(General::isEmpty($nombres)){ $nombres = NULL;}    
      
        $resultado = PersonalModel::Listado( $page_index, $page_size,$nombres);
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $resultado = PersonalModel::Insertar_Actualizar($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }

    public static function Personal_Desplegable(): RespuestaOperacion
    {
        $lista = PersonalModel::Personal_Desplegable();
        return new RespuestaOperacion($lista);
    }   
    public static function Anular(Array $datos): RespuestaOperacion
    {
        $resultado = PersonalModel::Anular($datos);

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