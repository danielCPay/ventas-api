<?php

namespace App\Logic\Mantenedores;

use App\Clases\RespuestaOperacion;
use App\Models\Mantenedores\MesaModel;
use App\Clases\General;

class MesaLogic
{
    public static function ListarMesasPisoById(Int $pisoid): RespuestaOperacion
    {      
        $lista = MesaModel::ListarMesasPisoById($pisoid);
        return new RespuestaOperacion($lista);
    }    

    public static function ActualizarEstadoMesa(Array $datos): RespuestaOperacion
    {
        $resultado = MesaModel::ActualizarEstadoMesa($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }

    public static function Listado(Int $page_index, Int $page_size, 
    $descripcionmesa, $pisoid): RespuestaOperacion
    {    
        if(General::isEmpty($descripcionmesa)){ $descripcionmesa = NULL;}    
        if(General::isEmpty($pisoid)){ $pisoid = NULL;}
      
        $resultado = MesaModel::Listado( $page_index, $page_size,$descripcionmesa,$pisoid);
        return new RespuestaOperacion($resultado);
    }

    public static function Insertar_Actualizar(Array $datos): RespuestaOperacion
    {
        $resultado = MesaModel::Insertar_Actualizar($datos);

        $mensaje = 'No se recibio respuesta de la Base Datos';
        $exito = FALSE;
        
        if(!General::isEmpty($resultado)){
            $mensaje = $resultado->mensaje; unset($resultado->mensaje);
            $exito = ($resultado->exito==0? FALSE:TRUE); unset($resultado->exito);
            if(!$exito){$resultado=null;}
        }
                
        return new RespuestaOperacion($resultado, $mensaje, $exito);

    }

    public static function Anular(Int $id, String $user): RespuestaOperacion
    {
        $resultado = MesaModel::Anular($id, $user);
        return new RespuestaOperacion(null, null, $resultado);
    }

}