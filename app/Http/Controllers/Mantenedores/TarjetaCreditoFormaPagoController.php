<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Logic\Mantenedores\TarjetaCreditoFormaPagoLogic;
use Illuminate\Http\Request;

class TarjetaCreditoFormaPagoController extends Controller
{
    public function __construct()
    {
    }

   
    public function TarjetaCredito_FormaPago_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {

            $formapagoid = intval($request->get("formapagoid"));

            if(General::isEmpty($formapagoid) || $formapagoid<=0){
                $formapagoid = NULL;
            }

            $res = TarjetaCreditoFormaPagoLogic::TarjetaCredito_FormaPago_Desplegable($formapagoid);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }


}