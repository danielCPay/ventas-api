<?php

namespace App\Http\Controllers\Almacen;
use App\Clases\General;
use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Almacen\MovimientosLogic;
use Illuminate\Http\Request;

class MovimientosController extends Controller
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

            $res = MovimientosLogic::Listado(
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
            $datos = (array)$request->get("movimientos");           
            $res = MovimientosLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }   
   
    public function ListadoStock(Request $request)
    {
        $res = new RespuestaOperacion();
        try {                       
            $almacenid = $request->input("almacenid", NULL); 
            $productoid = $request->input("productoid", NULL);

            $res = MovimientosLogic::ListadoStock(               
                $almacenid,       
                $productoid                       
            );
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    public function MovimientosAlmacenProductos(Request $request)
    {
        $res = new RespuestaOperacion();
        try {                       
            $almacenid = $request->input("almacenid", NULL); 
            $productoid = $request->input("productoid", NULL); 
            $fecha_inicio = $request->input("fecha_inicio", NULL);
            $fecha_fin = $request->input("fecha_fin", NULL);

            $res = MovimientosLogic::MovimientosAlmacenProductos(               
                $almacenid,
                $productoid,
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

}