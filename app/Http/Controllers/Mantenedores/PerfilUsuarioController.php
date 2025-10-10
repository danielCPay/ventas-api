<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\PerfilUsuarioLogic;
use Illuminate\Http\Request;

class PerfilUsuarioController extends Controller
{
    public function __construct()
    {
    }

    public function Perfil_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $res = PerfilUsuarioLogic::Perfil_Desplegable();
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}