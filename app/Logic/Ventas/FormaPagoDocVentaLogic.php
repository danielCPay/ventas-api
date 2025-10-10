<?php

namespace App\Logic\Ventas;

use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Models\Ventas\FormaPagoDocVentaModel;

class FormaPagoDocVentaLogic
{        

    public static function Listado(
        Int $page_index, Int $page_size, 
		$nroExpediente, $idTramite, $nroDocumento, $idTipoDocumento, $nombreApellido
    ): RespuestaOperacion
    {

        if(General::isEmpty($nroExpediente)){ $nroExpediente = NULL;}
        if(General::isEmpty($idTramite)){ $idTramite = NULL;}
        if(General::isEmpty($nroDocumento)){ $nroDocumento = NULL;}
        if(General::isEmpty($idTipoDocumento)){ $idTipoDocumento = NULL;}
        if(General::isEmpty($nombreApellido)){ $nombreApellido = NULL;}

        $resultado = VentasModel::Listado(
            $page_index, $page_size, 
            $nroExpediente, $idTramite, $nroDocumento, $idTipoDocumento, $nombreApellido
        );
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $datos['xml'] = General::convertir_array_a_xml($datos['formapagodetalle']);
        $resultado = FormaPagoDocVentaModel::Insertar_Actualizar($datos);
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