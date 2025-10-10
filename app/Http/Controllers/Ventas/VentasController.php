<?php

namespace App\Http\Controllers\Ventas;
use App\Clases\General;
use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Ventas\VentasLogic;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function __construct()
    {
    }

    public function Eliminar(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("expediente");
            $id = intval($datos['id']);
            $res = VentasLogic::Eliminar($id);
        } catch (\Exception $e) {
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function PedidoGetMesaid(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->input();
            $mesaid = intval($datos['mesaid']);       
            $res = VentasLogic::PedidoGetMesaid($mesaid);
        } catch (\Exception $e) {
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function PedidoDetalleGetId(Request $request)
    {
        $res = new RespuestaOperacion();
        try {

            $pedidoid = intval($request->get("pedidoid"));

            if(General::isEmpty($pedidoid) || $pedidoid<=0){
                $pedidoid = NULL;
            }

            $res = VentasLogic::PedidoDetalleGetId($pedidoid);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function ObtenerDetalleDocVentaId(Request $request)
    {
        $res = new RespuestaOperacion();
        try {

            $docventaid = intval($request->get("docventaid"));

            if(General::isEmpty($docventaid) || $docventaid<=0){
                $docventaid = NULL;
            }

            $res = VentasLogic::ObtenerDetalleDocVentaId($docventaid);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function Listado(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $page_index = intval($request->input("page_index", 1)) - 1;
            $page_size = intval($request->input("page_size", 10));

            $estado = $request->input("estado", NULL);
            $fecha_inicio = $request->input("fecha_inicio", NULL);
            $fecha_fin = $request->input("fecha_fin", NULL);
            $personalid = $request->input("personalid", NULL); 
            $tipodocumentoid = $request->input("tipodocumentoid", NULL);

            $res = VentasLogic::Listado(
                $page_index, 
                $page_size, 
                $estado, 
                $fecha_inicio, 
                $fecha_fin, 
                $tipodocumentoid,
                $personalid               
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
            $datos = (array)$request->get("venta");           
            $res = VentasLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function Actualizar_Docventa_NubeFact(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("venta");           
            $res = VentasLogic::Actualizar_Docventa_NubeFact($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function AnularVenta(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("venta");           
            $res = VentasLogic::AnularVenta($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function ActualizarVenta(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("venta");           
            $res = VentasLogic::ActualizarVenta($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}