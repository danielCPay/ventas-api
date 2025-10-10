<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\FamiliaLogic;
use Illuminate\Http\Request;

class FamiliaController extends Controller
{
    public function __construct()
    {
    }

    public function Familia_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $res = FamiliaLogic::Familia_Desplegable();
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}