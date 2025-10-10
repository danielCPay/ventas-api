<?php

namespace App\Http\Controllers\Almacen;
use App\Clases\General;
use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Almacen\NotaSalidaLogic;
use Illuminate\Http\Request;

class NotaSalidaController extends Controller
{
    public function __construct()
    {
    }
   
    public function Listado(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $page_index = intval($request->input("page_index", 1)) - 1;
            $page_size = intval($request->input("page_size", 10));
          
            $fecha_inicio = $request->input("fecha_inicio", NULL);
            $fecha_fin = $request->input("fecha_fin", NULL);          

            $res = NotaSalidaLogic::Listado(
                $page_index, 
                $page_size,           
                $fecha_inicio, 
                $fecha_fin                       
            );
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function Insertar_Actualizar(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("notasalida");           
            $res = NotaSalidaLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }       

    public function NumeracionNotaSalida(Request $request)
    {
        $res = new RespuestaOperacion();
        try {          
            $res = NotaSalidaLogic::NumeracionNotaSalida();

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function AnularNotaSalida(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("notasalida");           
            $res = NotaSalidaLogic::AnularNotaSalida($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    public function ObtenerDetalleNotaSalidaId(Request $request)
    {
        $res = new RespuestaOperacion();
        try {

            $notasalidaid = intval($request->get("notasalidaid"));

            if(General::isEmpty($notasalidaid) || $notasalidaid<=0){
                $notasalidaid = NULL;
            }

            $res = NotaSalidaLogic::ObtenerDetalleNotaSalidaId($notasalidaid);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function AnularNotaSalidaDetalle(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("notasalida");           
            $res = NotaSalidaLogic::AnularNotaSalidaDetalle($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }


}