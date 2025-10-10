<?php

namespace App\Http\Controllers\Compras;
use App\Clases\General;
use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Compras\ComprasLogic;
use Illuminate\Http\Request;

class ComprasController extends Controller
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

            $res = ComprasLogic::Listado(
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

    public function ListarComprasProvisionar(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $page_index = intval($request->input("page_index", 1)) - 1;
            $page_size = intval($request->input("page_size", 10));
          
            $fecha_inicio = $request->input("fecha_inicio", NULL);
            $fecha_fin = $request->input("fecha_fin", NULL);          

            $res = ComprasLogic::ListarComprasProvisionar(
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
            $datos = (array)$request->get("compra");           
            $res = ComprasLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }   

    public function AnularCompra(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("compra");           
            $res = ComprasLogic::AnularCompra($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function AnularCompraDetalle(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("compra");           
            $res = ComprasLogic::AnularCompraDetalle($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }    
    
    public function ObtenerDetalleDocCompraId(Request $request)
    {
        $res = new RespuestaOperacion();
        try {

            $doccompraid = intval($request->get("doccompraid"));

            if(General::isEmpty($doccompraid) || $doccompraid<=0){
                $doccompraid = NULL;
            }

            $res = ComprasLogic::ObtenerDetalleDocCompraId($doccompraid);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function ObtenerDetalleDocCompraProvionarId(Request $request)
    {
        $res = new RespuestaOperacion();
        try {

            $doccompraid = intval($request->get("doccompraid"));

            if(General::isEmpty($doccompraid) || $doccompraid<=0){
                $doccompraid = NULL;
            }

            $res = ComprasLogic::ObtenerDetalleDocCompraProvionarId($doccompraid);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function CondicionesPagoDesplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $res =ComprasLogic::CondicionesPagoDesplegable();
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function ExisteNumFactCompra(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->input();
            $seriecomprobante = $datos['seriecomprobante'];    
            $numcomprobante = $datos['numcomprobante'];  
            $tipocomprobanteid = intval($datos['tipocomprobanteid']);  
            $proveedorid = intval($datos['proveedorid']);     
            $res = ComprasLogic::ExisteNumFactCompra($seriecomprobante,
            $numcomprobante,$tipocomprobanteid,$proveedorid);
        } catch (\Exception $e) {
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}