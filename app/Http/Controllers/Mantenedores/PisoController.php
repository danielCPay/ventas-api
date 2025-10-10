<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\PisoLogic;
use Illuminate\Http\Request;

class PisoController extends Controller
{
    public function __construct()
    {
    }

    public function Piso_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $res = PisoLogic::Piso_Desplegable();
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
            $datos = (array)$request->get("piso");
            //$datos['idUsuario']=1;
            $res = PisoLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}