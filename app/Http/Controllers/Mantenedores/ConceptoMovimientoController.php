<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\ConceptoMovimientoLogic;
use Illuminate\Http\Request;

class ConceptoMovimientoController extends Controller
{
    public function __construct()
    {
    }

    public function Concepto_Movimiento_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $res = ConceptoMovimientoLogic::Concepto_Movimiento_Desplegable();
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}