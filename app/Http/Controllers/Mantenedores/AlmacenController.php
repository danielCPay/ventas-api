<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\AlmacenLogic;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    public function __construct()
    {
    }

    public function Almacen_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $res = AlmacenLogic::Almacen_Desplegable();
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}