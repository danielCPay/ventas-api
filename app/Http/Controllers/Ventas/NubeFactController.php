<?php

namespace App\Http\Controllers\Ventas;


use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Logic\Ventas\NubeFactLogic;
use Illuminate\Http\Request;

class NubeFactController extends Controller
{
    public function __construct()
    {
    }

    public function EnviarComprobanteNubeFact(Request $request)
    {
        $res = new RespuestaOperacion();
        try {         
            $datos = (array)$request->get("venta");         
            $res = NubeFactLogic::EnviarComprobanteNubeFact($datos);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }      

        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function AnularComprobanteNubeFact(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->input();         
            //$datos['docventaid'] = array_key_exists('docventaid',$datos)? $datos['docventaid']:NULL;
            $datos = (array)$request->get("venta");        
            $res = NubeFactLogic::AnularComprobanteNubeFact($datos);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }      
        return RespuestaOperacion::enviarJsonObj($res);

    }
    public function ConsultarComprobanteNubeFact(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->input();         
            //$datos['docventaid'] = array_key_exists('docventaid',$datos)? $datos['docventaid']:NULL;
            $datos = (array)$request->get("venta");             
            $res= NubeFactLogic::ConsultarComprobanteNubeFact($datos);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }      
        return RespuestaOperacion::enviarJsonObj($res);
    }

}