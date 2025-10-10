<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\SubCategoriaLogic;
use Illuminate\Http\Request;

class SubCategoriaController extends Controller
{
    public function __construct()
    {
    }

    public function SubCategoria_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $res = SubCategoriaLogic::SubCategoria_Desplegable();
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}