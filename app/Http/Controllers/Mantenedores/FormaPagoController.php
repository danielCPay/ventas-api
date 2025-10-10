<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\FormaPagoLogic;
use Illuminate\Http\Request;

class FormaPagoController extends Controller
{
    public function __construct()
    {
    }

    public function Forma_Pago_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $res =FormaPagoLogic::Forma_Pago_Desplegable();
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}