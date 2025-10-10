<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\MonedaLogic;
use Illuminate\Http\Request;

class MonedaController extends Controller
{
    public function __construct()
    {
    }

    public function Moneda_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $res =MonedaLogic::Moneda_Desplegable();
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}