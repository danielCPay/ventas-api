<?php

namespace App\Http\Controllers\Pedido;
use App\Clases\General;
use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Pedido\PedidoLogic;
use Illuminate\Http\Request;

class PedidoController extends Controller
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
            $res = PedidoLogic::Eliminar($id);
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
            $res = PedidoLogic::PedidoGetMesaid($mesaid);
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
            $datos=(array)$request->input();    
            $pedidoid = intval($datos['pedidoid']);

            /*if(General::isEmpty($pedidoid) || $pedidoid<=0){
                $pedidoid = NULL;
            }*/

            $res = PedidoLogic::PedidoDetalleGetId($pedidoid);

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
          
            $res = PedidoLogic::Listado(
                $page_index, $page_size, 
                $estado, $fecha_inicio, $fecha_fin, $personalid
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
            $datos = (array)$request->get("pedido");           
            $res = PedidoLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function ActualizarEstadoPedido(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("pedido");           
            $res = PedidoLogic::ActualizarEstadoPedido($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function ActualizarMesaPedido(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("pedido");           
            $res = PedidoLogic::ActualizarMesaPedido($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function AnularPedidoDetalle(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("pedido");           
            $res = PedidoLogic::AnularPedidoDetalle($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function TransferirPedido(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("pedido");           
            $res = PedidoLogic::TransferirPedido($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}