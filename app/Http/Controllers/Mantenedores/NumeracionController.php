<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Clases\General;
use App\Logic\Mantenedores\NumeracionLogic;
use Illuminate\Http\Request;

class NumeracionController extends Controller
{
    public function __construct()
    {
    }

    public function NumeracionComprobante(Request $request)
    {
        $res = new RespuestaOperacion();
        try {

            /*$tipodocumento = $request->get("tipodocumento");
            $razon = $request->get("razon");
            $res =NumeracionLogic::NumeracionComprobante($tipodocumento,$razon);*/
            $datos = (array)$request->input();
            //$id = intval($datos['id']);
            $tipodocumento = $datos['tipodocumento'];
            $razon = $datos['razon'];           

            $res = NumeracionLogic::NumeracionComprobante($tipodocumento,$razon);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function Actualizar_Ultimo_Numero_Usado(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("numeracion");
            //$datos['idUsuario']=1;
            $res = NumeracionLogic::Actualizar_Ultimo_Numero_Usado($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    

}