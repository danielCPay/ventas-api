<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\ClienteModel;
use App\Clases\General;

class ClienteLogic
{   
    public static function Listado(Int $page_index, Int $page_size, 
    $razonsocial): RespuestaOperacion
    {    
        if(General::isEmpty($razonsocial)){ $razonsocial = NULL;}    
      
        $resultado = ClienteModel::Listado( $page_index, $page_size,$razonsocial);
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $resultado = ClienteModel::Insertar_Actualizar($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }
    public static function ClienteGetNroDocumento(String $nrdocumento): RespuestaOperacion
    {
        $resultado = ClienteModel::ClienteGetNroDocumento($nrdocumento);
        if(General::isEmpty($resultado)){$resultado=NULL;}
        return new RespuestaOperacion($resultado);
    }

    public static function Cliente_Desplegable($tipodocumento): RespuestaOperacion
    {
        if(General::isEmpty($tipodocumento)){ $tipodocumento = NULL;}   

        $resultado = ClienteModel::Cliente_Desplegable($tipodocumento);

       if(General::isEmpty($resultado)){$resultado=NULL;}
       
        return new RespuestaOperacion($resultado);
    }   
    public static function Anular(Array $datos): RespuestaOperacion
    {
        $resultado = ClienteModel::Anular($datos);

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