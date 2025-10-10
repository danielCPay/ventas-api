<?php

namespace App\Http\Controllers\Mantenedores;

use App\Http\Controllers\Controller;
use App\Clases\RespuestaOperacion;
use App\Logic\Mantenedores\SubFamiliaLogic;
use Illuminate\Http\Request;
use App\Clases\General;

class SubFamiliaController extends Controller
{
    public function __construct()
    {
    }

    public function SubFamilia_Desplegable(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $res = SubFamiliaLogic::SubFamilia_Desplegable();
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

    public function SubFamiliaGetId(Request $request)
    {
        $res = new RespuestaOperacion();
        try {

            $familiaid = intval($request->get("familiaid"));

            if(General::isEmpty($familiaid) || $familiaid<=0){
                $familiaid = NULL;
            }

            $res = SubFamiliaLogic::SubFamiliaGetId($familiaid);

        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    public function Listado(Request $request)
    {     
        $res = new RespuestaOperacion();
        try {
            $page_index = intval($request->input("page_index", 1)) - 1;
            $page_size = intval($request->input("page_size", 10));
          
            $descripcionsubfamilia = $request->input("descripcionsubfamilia", NULL);

            $res = SubFamiliaLogic::Listado(
                $page_index, $page_size, $descripcionsubfamilia
            );
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
            $datos = (array)$request->get("subfamilia");
            //$datos['idUsuario']=1;
            $res = SubFamiliaLogic::Insertar_Actualizar($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }
    public function Anular(Request $request)
    {
        $res = new RespuestaOperacion();
        try {
            $datos = (array)$request->get("subfamilia");           
            $res = SubFamiliaLogic::Anular($datos);
        } catch (\Exception $e) {
            dd($e);
            $res->mensaje = "Error no especificado";
            $res->exito = false;
        }
        return RespuestaOperacion::enviarJsonObj($res);
    }

}