<?php

namespace App\Http\Controllers\Almacen;
use App\Clases\General;
use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Almacen\NotaIngresoLogic;
use Illuminate\Http\Request;

class NotaIngresoController extends Controller
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

            $res = NotaIngresoLogic::Listado(
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
            $datos = (array)$request->get("notaingreso");           
            $res = NotaIngresoLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }       

    public function NumeracionNotaIngreso(Request $request)
    {
        $res = new RespuestaOperacion();
        try {          
            $res = NotaIngresoLogic::NumeracionNotaIngreso();

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function AnularNontaIngreso(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("notaingreso");           
            $res = NotaIngresoLogic::AnularNontaIngreso($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    public function ObtenerDetalleNotaIngresoId(Request $request)
    {
        $res = new RespuestaOperacion();
        try {

            $notaentradaid = intval($request->get("notaentradaid"));

            if(General::isEmpty($notaentradaid) || $notaentradaid<=0){
                $notaentradaid = NULL;
            }

            $res = NotaIngresoLogic::ObtenerDetalleNotaIngresoId($notaentradaid);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    public function AnularNotaIngresoDetalle(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("notaingreso");           
            $res = NotaIngresoLogic::AnularNotaIngresoDetalle($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}