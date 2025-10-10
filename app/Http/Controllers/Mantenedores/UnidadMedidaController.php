<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\UnidadMedidaLogic;
use Illuminate\Http\Request;

class UnidadMedidaController extends Controller
{
    public function __construct()
    {
    }

    public function Unidad_Medida_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $res = UnidadMedidaLogic::Unidad_Medida_Desplegable();
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}