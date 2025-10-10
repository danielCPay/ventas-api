<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\CargoLogic;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function __construct()
    {
    }

    public function Cargo_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $res =CargoLogic::Cargo_Desplegable();
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}