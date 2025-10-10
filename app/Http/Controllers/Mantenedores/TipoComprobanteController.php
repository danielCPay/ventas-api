<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Logic\Mantenedores\TipoComprobanteLogic;
use Illuminate\Http\Request;

class TipoComprobanteController extends Controller
{
    public function __construct()
    {
    }

    public function TipoComprobante_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {

            $proceso = $request->get("proceso");

            if(General::isEmpty($proceso)){
                $proceso = NULL;
            }

            $res =TipoComprobanteLogic::TipoComprobante_Desplegable($proceso);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}